<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'cryptocurrency_id',
        'balance',
    ];
    public function user() // Получить пользователя, которому принадлежит этот кошелек.
    {
        return $this->belongsTo(User::class);
    }

    public function cryptocurrency() // Получить криптовалюту, которой принадлежит этот кошелек.
    {
        return $this->belongsTo(Cryptocurrency::class);
    }

}
