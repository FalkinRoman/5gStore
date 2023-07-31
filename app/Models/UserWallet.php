<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    protected $table = 'user_wallets';

    public function user() //Получить пользователя, связанного с этой записью в таблице user_wallets.
    {
        return $this->belongsTo(User::class);
    }


    public function wallet() //Получить кошелек, связанный с этой записью в таблице user_wallets.
    {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }

}
