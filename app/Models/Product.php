<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //функция возвращает категорию продукта
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function getPriceForCount() {    //общая стоимость для колличества товаров
        if(! is_null($this->pivot)){
            return $this->pivot->count * $this->priсe;
        }
        return $this->price;
    }
}
