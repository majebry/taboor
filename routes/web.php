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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('client')->namespace('Client')->middleware('auth:client')->group(function() {
    Route::get('merchants', 'MerchantController@index')->name('client.merchants.index');
});

Route::prefix('merchant')->namespace('Merchant')->middleware('auth:merchant')->name('merchant.')->group(function() {
    Route::get('/', function () {
        return 'test';
    });
    Route::resource('bookings', 'BookingController', ['only' => 'index']);
});



Route::prefix('api/v1')->namespace('API\V1')->group(function() {
    Route::prefix('client')->namespace('Client')->middleware('auth:client')->group(function() { // auth
        Route::get('merchants', 'MerchantController@index');
        Route::post('merchants/{id}/bookings', 'BookingController@store');
        Route::delete('bookings/{id}', 'BookingController@destroy');
    });

    Route::prefix('merchant')->namespace('Merchant')->middleware('auth:merchant')->group(function() { // auth
        Route::get('bookings', 'BookingController@index');
        Route::delete('bookings/{id}', 'BookingController@destroy');
        Route::post('bookings/{id}/dealing', 'DealingController@store');
    });
});
