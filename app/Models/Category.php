<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['code', 'name', 'description', 'image'];
    //Функция для получения всех продуктов категории
    public function products() {
        return $this->hasMany(Product::class);
    }
}
