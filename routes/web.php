<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['switchLan'],'namespace'=>'Web'],function(){
    Route::post('changeLocale', 'IndexController@changeLocale')->name('changeLocale');
    Route::post('getSlideshow','IndexController@getSlideshowList')->name('getSlideshow');
    Route::post('getCate','IndexController@getCateList')->name('getCate');
    Route::post('search','GoodsController@search')->name('search');
    Route::post('getGoods','GoodsController@getGoodsList')->name('getGoods');
    Route::post('getHotGoods','GoodsController@getHotGoodsList')->name('getHotGoods');
    Route::post('getDetail','GoodsController@getGoodsDetail')->name('getDetail');
    Route::post('createOrder','OrderController@createOrder')->name('createOrder');
    Route::post('searchOrder','OrderController@searchOrder')->name('searchOrder');



});


