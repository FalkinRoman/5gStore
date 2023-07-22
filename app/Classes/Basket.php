<?php

namespace App\Classes;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    public function __construct($createOrder = false)
    {
        $orderId = session('orderId');
        if (is_null($orderId) && $createOrder) {
            $data = [];
            //Если пользователь авторизован добавляем в таблицу заказ user_id
            if (Auth::check()){
                $data['user_id']= Auth::id();
            };
            $this->order = Order::create($data);
            session(['orderId' => $this->order->id]);
        } else {
            $this->order = Order::findOrFail($orderId);
        }

    }

    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable($updateCount = false)  //функция доступен ли товар к колличестве,и удаление после заказа колличества товара
    {
        foreach ($this->order->products as $orderProduct)
        {
            if ($orderProduct->count < $this->getPivotRow($orderProduct)->count) {
                return false;
            }
            if ($updateCount) {
                $orderProduct->count -= $this->getPivotRow($orderProduct)->count; //удаление колличества с таблицы
            }
        }

        if ($updateCount) {
            $this->order->products->map->save(); //проходим по товарам и сохраняем
        }
        return true;
    }

    public function saveOrder($name, $phone, $email)
    {
        if (!$this-> countAvailable(true)){
            return false;
        }
        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
        return $this->order->saveOrder($name, $phone);
    }

    protected function getPivotRow($product)
    {
        return $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }

    public function addProduct(Product $product)
    {
        if($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            $pivotRow->count++;
            if ($pivotRow->count > $product->count){   //проверка на добавление и колличества товара на складе
                return false;
            }
            $pivotRow->update();
        }else{
            if ($product->count == 0) {
                return false;
            }
            // Привязываем продукт через связующую таблицу
            $this->order->products()->attach($product->id);
        }

        //Добавляем продукт в функцию подсчета суммы
        Order::changeFullSum($product->price);

        return true;
    }



    public function removeProduct(Product $product)
    {
        if($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            if ($pivotRow->count < 2){
                $this->order->products()->detach($product->id);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        //убираем продукт в функцию подсчета суммы
        Order::changeFullSum(-$product->price);

    }
}
