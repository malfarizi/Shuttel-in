<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        //set indonesian config carbon date
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');

        Paginator::useBootstrap();

        Blade::directive('money', function ($price) {
            return "Rp. <?= number_format($price, 0, ',', '.'); ?>";
        });

        Blade::directive('date', function ($value) {
            return "<?= \Carbon\Carbon::parse($value)->translatedFormat('l, d F Y'); ?>";
        });
    }
}
