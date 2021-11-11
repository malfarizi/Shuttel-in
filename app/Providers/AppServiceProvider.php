<?php

namespace App\Providers;

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

        // custom directive date
        Blade::directive('date', function ($param) {
            return "<?= \Carbon\Carbon::parse($param)->translatedFormat('l, d F Y'); ?>";
        });

        // custom directive money
        Blade::directive('money', function ($expression) {
            return "Rp. <?= number_format($expression, 0, ',', '.'); ?>";
        });
    }
}
