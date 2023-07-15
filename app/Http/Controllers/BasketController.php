<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BasketController extends Controller
{
    public function basket()    //Страница корзины
    {
        //Поменял !is null, добавил session и redirect
        $orderId = session('orderId');
        if(is_null($orderId)) {
            session()->flash('warning', 'Ваша корзина пуста!');
            return redirect()->route('index');
        }
        $order = Order::findOrFail($orderId);
        return view('basket', compact('order'));
    }

    public function basketPlace()  //Страница оформления заказа
    {
        $orderId = session('orderId');
        if(is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    public function basketConfirm(Request $request)   //Потвердить заказ
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success =$order->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        }else{
            session()->flash('warning', 'Случилась ошибка!');
        }

        return redirect()->route('index');
    }



    public function basketAdd(Request $request, $productId)  //Добавление товара в корзину
    {
        // Ищем сессию с ключом заказа
        $orderId = $request->session()->get('orderId');

        // Если нет, добавляем ключ в сессию
        if (is_null($orderId)) {
            $order = Order::create();
            $request->session()->put('orderId', $order->id);
        } else {
            // Если есть, находим заказ по ID
            $order = Order::findOrFail($orderId);
        }

        if($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }else{
            // Привязываем продукт через связующую таблицу
            $order->products()->attach($productId);
        }

        //Если пользователь авторизован добавляем в таблицу заказ user_id
        if (Auth::check()){
            $order->user_id= Auth::id();
            $order->save();
        };

        //функционал для уведомления после добавления товара
        $product = Product::find($productId);
        session()->flash('success', 'Добавлен товар ' . $product->name);

        // Возвращаем страницу корзины с товарами
        return redirect()->route('basket');
    }


    public function basketRemove(Request $request, $productId)    //Удаление товара с корзины
    {
        $orderId = $request->session()->get('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2){
                $order->products()->detach($productId);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        //функционал для уведомления после удаления товара с корзины
        $product = Product::find($productId);
        session()->flash('warning', 'Удален товар ' . $product->name);
        return redirect()->route('basket');
    }



}











//    public function basketAdd($productId)
//    {
//        //ищем сессию с ключом с заказом
//        $orderId = session('orderId');
//
//        //если нет добавляем ключ в сессию
//        if(is_null($orderId)) {
//            $order = Order::create()->id;
//            session(['orderId' => $order->id]);
//        }else{
//            //если есть находим заказ по id
//            $order = Order::find($orderId);
//        }
//        //привязываем через продукты в 3 связующую таблицу
//        $order->products()->attach($productId);
//
//        //возвращаем страницу корзины с товарами
//        return view('basket', compact('order'));
//    }
