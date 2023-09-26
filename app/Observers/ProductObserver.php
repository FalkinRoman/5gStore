<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subscription;

class  ProductObserver
//используется и автоматически вызывается класс когда что-то изменилось в модели product
//Observer - регистрируется в AppServiceProvider чтобы начал работать
{
    public function updating(Product $product)
    {
        $oldCount = $product->getOriginal('count'); //получаем старое значение продукта (кол-ва)
        if ($oldCount == 0 && $product->count > 0) {     //старое значение == 0 ,а новое значение больше 0
            Subscription::sendEmailsBySubscription($product);  //вызывам статический метод по отправке емайл
        }

    }
}
