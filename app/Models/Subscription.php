<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = ['email', 'product_id'];

    public function scopeActiveByProductId($query, $productId)
    {
        return $query->where('status', 0 )->where('product_id', $productId );
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function sendEmailsBySubscription(Product $product)
    {
        $subscriptions = self::activeByProductId($product->id)->get(); //находим все уведомления которые зарегистрированы
        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionMessage($product)); //отправляем продукт по email
            $subscription->status = 1; //меняем статус на исполненный
            $subscription->save();
        }
    }

}
