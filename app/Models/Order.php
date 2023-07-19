<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    //scope - для заказов в админе и юзере
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function calculateFullSum() //считает общую стоимость заказа
    {
        $sum = 0;
        foreach ($this ->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    public static function changeFullSum($productPrice) //изменение суммы заказа
    {
        $sum = self::getFullSum() + $productPrice;
        session(['full_order_sum' => $sum]);
    }

    public static function eraceOrderSum() //стираем сессию суммы заказа после оформления
    {
       session()->forget('full_order_sum');
    }



    public static function getFullSum()   //достает с сессии сумму заказа
    {
        return session('full_order_sum', 0);
    }


    public function saveOrder($name, $phone)  //сохраняем заказ в таблице, статус оформлен, и передаем данные пользователя имя и телефон
    {
        if($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        }else{
            return false;
        }

    }

}
