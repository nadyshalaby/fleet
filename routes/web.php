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

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['admin'])->group(function () {
    Route::resource('user', 'UserController');
    Route::resource('trip', 'TripController');
    Route::resource('station', 'StationController');

    Route::post('trip/{trip}/add-stop', 'TripController@addStop')->name('trip.stop.add');
    Route::post('trip/{trip}/remove-stop', 'TripController@removeStop')->name('trip.stop.remove');

    Route::get('trip/{trip}/bookings', 'TripController@bookings')->name('trip.bookings');
    Route::post('trip/{trip}/add-booking', 'TripController@addBooking')->name('trip.booking.add');
    Route::post('trip/{trip}/remove-booking', 'TripController@removeBooking')->name('trip.booking.remove');
});
