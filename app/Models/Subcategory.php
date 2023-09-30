<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name',  'image', 'category_id'];
    //получить категорию у подкатегории
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //получить продукты подкатегории
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
