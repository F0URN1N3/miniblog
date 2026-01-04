<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        // 檢查是否在正式環境 (Render 上通常會設為 production)
        if (config('app.env') === 'production') {
            URL::forceScheme('https'); // 這樣就不會有紅線了
        }
        //避免Paginator出現不合比例的換頁符號
        Paginator::useBootstrap();
    }
}
