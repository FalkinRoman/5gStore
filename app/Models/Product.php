<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use SoftDeletes; //траит на удаление товара (оставляет его в базе, но записваерт в поле delete_at время  и дату, позволяет использовать функционал класса)

    protected $fillable = ['code','category_id','subcategory_id','brand_id', 'name', 'description', 'image', 'price', 'hit', 'new', 'recommend', 'count',];
    //функция возвращает категорию продукта
    public function category() {
        return $this->belongsTo(Category::class);
    }

    //функция возвращает субкатегорию продукта
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    //функция возвращает брэнд продукта
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function cashbacks() //получение всех кэшбэков для данного товара
    {
        return $this->hasMany(ProductCashback::class, 'product_id');
    }




    public function getPriceForCount() {    //общая стоимость для колличества товаров
        if(! is_null($this->pivot)){
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function getPriceForCrypto() {    //общая стоимость для колличества кэшбэков криптовалюты
        if(! is_null($this->pivot)){
            return $this->pivot->count * $this->calculateCashbackAmount();
        }
        return $this->calculateCashbackAmount();
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

    // Отношение "многие-ко-многим" с моделью Cryptocurrency через промежуточную таблицу ProductCashback
    public function cryptocurrencies() //получить всю криптовалюту
    {
        return $this->belongsToMany(Cryptocurrency::class, 'product_cashbacks')
            ->withPivot('cashback_percentage');
    }



    //Метод для получения кешбэка в криптовалюте (главный)
    public function calculateCashbackAmount()
    {
        // Получаем процент кешбэка и считаем его в рублях от цены товара
        if ($this->cashbacks()->exists()) {
            $cashbackPercentage = $this->cashbacks->first()->cashback_percentage;
            $cashbackInRubles = $this->price * ($cashbackPercentage / 100);

            // Проверяем, есть ли закэшированное значение цены USDT к рублю
            $usdToRubRate = Cache::remember('usdt_to_rub_rate', now()->addMinutes(5), function () {
                $url = 'https://api.binance.com/api/v3/ticker/price?symbol=USDTRUB';
                $data = file_get_contents($url);
                $data = json_decode($data, true);
                return (float) $data['price'];
            });

            // Переводим кэшбэк из рублей в доллары
            $cashbackInUSD = $cashbackInRubles / $usdToRubRate;

            // Получаем криптовалюту для данного товара
            $cryptocurrencies = $this->cryptocurrencies;

            // Получаем символ первой связанной криптовалюты из коллекции
            $cryptocurrencySymbol = $cryptocurrencies->first()->symbol;

            // Получаем текущую цену криптовалюты по символу
            $cryptocurrencyPrice = Cryptocurrency::getCurrentPriceBySymbol($cryptocurrencySymbol);

            // Получаем кол-во монет в кэшбэк
            $cashbackInCoin = $cashbackInUSD / $cryptocurrencyPrice;

            // Округляем результат до четырех десятичных знаков
            $cashbackInCoin = number_format($cashbackInCoin, 4);

            return $cashbackInCoin;
        }

        return 0;
    }

}
