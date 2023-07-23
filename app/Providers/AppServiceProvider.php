<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;

//добавил длдя пагинации
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     * Сюда можем добавлять свои дериктивы для шаблона blade
     * @return void
     */
    public function boot()
    {
//        Blade::directive('routeactive', function ($route) {
/*            return "<?php echo Route::currentRouteNamed($route) ? 'class = \"text-white\"' : ''  ?>";*/
//        });
        Paginator::useBootstrap(); //пагинация для bootstrap по умолчанию tailvind

        Product::observe(ProductObserver::class); //observer - для изменения продуктов (наблюдатель)
    }
}
