<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Cryptocurrency extends Model
{
    protected $fillable = [
        'symbol',
        'name',
        'image',
    ];

    public function wallets() //Получить кошельки для данной криптовалюты.
    {
        return $this->hasMany(Wallet::class);
    }

    public static function getCurrentPriceBySymbol($symbol) //получить цену криптовалюты
    {
        $response = Http::get("https://api.binance.com/api/v3/ticker/price", [
            'symbol' => strtoupper($symbol), // Переводим символ криптовалюты в верхний регистр
        ]);

        $data = $response->json();
        return isset($data['price']) ? (float) $data['price'] : null;
    }


}
