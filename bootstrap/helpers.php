<?php
//测试方法
function test_ok(){
    return 'OK';
}

//
function route_class(){
    return str_replace('.','-',\Illuminate\Support\Facades\Route::currentRouteName());
}