<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id'];


    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function cashbackHistory()
    {
        return $this->hasMany(CashbackHistory::class, 'order_id');
    }

    //scope - для заказов в админе и юзере
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function calculateFullSum() //считает общую стоимость заказа
    {
        $sum = 0;
        foreach ($this ->products()->withTrashed()->get() as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

  public function calculateTotalSumForCrypto() //итог суммы кэшбэка криптовалют в заказе
  {
      $cryptoSumArray = [];

      foreach ($this->products()->withTrashed()->get() as $product) {
          $cryptoSymbol = $product->cryptocurrencies->first()->image;
          $priceForCrypto = $product->getPriceForCrypto();
          $cryptoSmallName = $product->cryptocurrencies->first()->small_name;
          $cryptoId = $product->cryptocurrencies->first()->id; // Добавьте это

          if (isset($cryptoSumArray[$cryptoSymbol])) {
              $cryptoSumArray[$cryptoSymbol]['totalSum'] += $priceForCrypto;
          } else {
              $cryptoSumArray[$cryptoSymbol] = [
                  'totalSum' => $priceForCrypto,
                  'smallName' => $cryptoSmallName,
                  'cryptocurrency_id' => $cryptoId,
              ];
          }
      }

      return $cryptoSumArray;
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
