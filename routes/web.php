<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//laravel 路由解析是按照顺序的 products/{product}/favorite 和products/{product} 谁在前解析谁
//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/','PagesController@root')->name('root');
//Route::get('/','PagesController@root')->name('root')->middleware('verified');//测试邮箱验证功能

Auth::routes(['verify'=>true]);

//用户地址列表路由
Route::group(['middleware'=>['auth','verified']],function (){
    Route::get('user_addresses','UserAddressesController@index')->name('user_addresses.index');
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
    Route::post('user_addresses','UserAddressesController@store')->name('user_addresses.store');
    Route::get('user_addresses/{user_address}','UserAddressesController@edit')->name('user_addresses.edit');
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
    Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

    //收藏相关路由
    Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
    Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');
    Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');

    //购物车相关
    Route::post('cart', 'CartController@add')->name('cart.add');
});

Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');

Route::get('products/{product}','ProductsController@show')->name('products.show');
