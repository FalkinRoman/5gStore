<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes; //траит на удаление товара (оставляет его в базе, но записваерт в поле delete_at время  и дату, позволяет использовать функционал класса)

    protected $fillable = ['code','category_id', 'name', 'description', 'image', 'price', 'hit', 'new', 'recommend', 'count'];
    //функция возвращает категорию продукта
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function getPriceForCount() {    //общая стоимость для колличества товаров
        if(! is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    //Мутаторы - автоматически записывает значения в базу данных названных атрибутов запись функции начинается с  setNewAttribute($value)
    public function setNewAttribute($value) {
        $this->attributes['new'] =$value === 'on' ? 1: 0;
    }

    public function setHitAttribute($value) {
        $this->attributes['hit'] =$value === 'on' ? 1: 0;
    }

    public function setRecommendAttribute($value) {
        $this->attributes['recommend'] =$value === 'on' ? 1: 0;
    }


    //Scope - добавляет к запросу значения поиска
    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }
    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }


    //Используем в верстке для отображения или нет
    public function isHit() {
        return $this->hit === 1;
    }

    public function isNew() {
        return $this->new === 1;
    }

    public function isRecommend() {
        return $this->recommend === 1;
    }

    public function isAvailable()   //есть ли товар в наличии
    {
        return !$this->trashed() && $this->count > 0;
    }

}
