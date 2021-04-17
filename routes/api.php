<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::get('booking', 'BookingController@index')->name('booking.index');
Route::get('booking/trips', 'BookingController@trips')->name('booking.trips');
Route::post('booking/{trip}', 'BookingController@book')->name('booking.book');
Route::post('booking/{trip}/available', 'BookingController@available')->name('booking.available');
