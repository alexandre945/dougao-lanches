<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y H:i');?>";
        });

        blade::directive('date', function ($expression) {
            return "<?php echo ($expression)->format('d/m/Y');?>";
        });

        blade::directive('money', function($expression) {
            return "<?php echo number_format($expression, 2, ',', '.');?>";
        });
    }
}
