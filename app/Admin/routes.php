<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('cate', 'CateController');
    $router->resource('config', 'ConfigController');
    $router->resource('slideshow', 'SlideshowController');
    $router->resource('label', 'LabelController');
    $router->resource('goods', 'GoodController');

});
