<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Yansongda\Pay\Pay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //往服务容器中注入一个名为alipay的单例对象
        $this->app->singleton('alipay',function (){
            $config=config('pay.alipay');
            $config['return_url']=route('payment.alipay.return');//前端回调
//            $config['notify_url']=route('payment.alipay.notify');//服务端回调
            $config['notify_url']='http://requestbin.net/r/1l36qk21';//服务端回调例子演示
            //判断当前项目的运行环境
            if(app()->environment()!=='production'){
                $config['mode']='dev';
                $config['log']['level']=Logger::DEBUG;
            }else{
                $config['log']['level']=Logger::WARNING;
            }
            //调用Yansongda\Pay创建一个支付宝支付对象
            return Pay::alipay($config);
        });
        $this->app->singleton('wechat_pay',function (){
            $config=config('pay.wechat');
            if(app()->environment()!=='production'){
                $config['log']['level']=Logger::DEBUG;
            }else{
                $config['log']['level']=Logger::WARNING;
            }
            return Pay::wechat($config);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
