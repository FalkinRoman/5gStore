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

    public function getFullPrice()   //считает общую стоимость заказа
    {
        $sum = 0;
        foreach ($this ->products as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
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
