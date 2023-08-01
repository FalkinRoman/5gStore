<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCashback extends Model
{
    protected $fillable = ['product_id', 'cryptocurrency_id', 'cashback_percentage'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cryptocurrency()
    {
        return $this->belongsTo(Cryptocurrency::class);
    }

}
