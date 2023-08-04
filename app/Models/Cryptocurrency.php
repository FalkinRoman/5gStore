<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Cryptocurrency extends Model
{
    protected $fillable = [
        'symbol',
        'name',
        'image',
        'small_name',
    ];

    public function wallets() //Получить кошельки для данной криптовалюты.
    {
        return $this->hasMany(Wallet::class);
    }

    public function cashbacks() //получение всех кешбэков для данной криптовалюты
    {
        return $this->hasMany(ProductCashback::class, 'cryptocurrency_id');
    }

    public static function getCurrentPriceBySymbol($symbol) //получить цену криптовалюты с кешированием на 5 минут
    {
        $cacheKey = 'cryptocurrency_price_' . $symbol;
        $cacheDuration = now()->addMinutes(5);

        // Проверяем, есть ли значение в кэше
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Получаем цену криптовалюты через API Binance
        $response = Http::get("https://api.binance.com/api/v3/ticker/price", [
            'symbol' => strtoupper($symbol),
        ]);

        $data = $response->json();
        $price = isset($data['price']) ? (float) $data['price'] : null;

        // Кешируем значение на 5 минут
        Cache::put($cacheKey, $price, $cacheDuration);

        return $price;
    }




}
