<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; //追加

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
        Paginator::useBootstrap(); //TailwindCSSでなくbootstrapを使う
        //ログイン機能
        \URL::forceScheme('https'); //URLのhttps化
        $this->app['request']->server->set('HTTPS', 'on'); //ペジネーション
    }
}
