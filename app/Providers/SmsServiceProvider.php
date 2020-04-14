<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Overtrue\EasySms\EasySms;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * register方法只需要将服务绑定到服务容器中
     * @return void
     */
    public function register()
    {
        //todo
        $this->app->singleton(SmsServiceProvider::class,function($app){
            return new EasySms(config('sms'));
        });
        $this->app->alias(SmsServiceProvider::class,'sms');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
