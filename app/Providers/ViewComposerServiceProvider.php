<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider

//при загрузке представлений и позволяет передавать данные в представления без определенного роута у нас в мастере
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.master'], function ($view) {
            // Здесь вы можете получить данные, например, категории, из вашей модели или другого источника данных
            $categories = Category::all(); // Пример получения всех категорий из модели Category

            // Передайте данные в представление
            $view->with('categories', $categories);
        });

    }
}
