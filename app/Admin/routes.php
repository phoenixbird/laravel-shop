<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->get('users', 'UsersController@index');

    $router->get('products', 'ProductsController@index');

    //显示上架商品列表
    $router->get('products/create', 'ProductsController@create');
    $router->post('products', 'ProductsController@store');
    //编辑商品
    $router->get('products/{id}/edit', 'ProductsController@edit');
    $router->put('products/{id}', 'ProductsController@update');

});
