<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
    }
}
