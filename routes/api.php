<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

  Route::post('login', 'Api\AuthController@login')->name('api.login');
  Route::apiResource('orders', 'Api\OrderController', ['as' => 'api'])->middleware('auth:api')
                                                        ->only('index', 'store', 'show');
  Route::post('orders/update', 'Api\OrderController@update')->name('api.orders.update')->middleware('auth:api');
