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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){
    Route::get('/', function () {
        return view('admin.home');
    })->middleware('auth.admin');

    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'RegisterController@register')->name('admin.register.store');

    Route::get('/login', 'LoginController@showLoginForm')->name('admin.auth.loginForm');
    Route::post('/login', 'LoginController@login')->name('admin.auth.login');
    Route::post('/logout', 'LoginController@logout')->name('admin.auth.logout');

    Route::get('/payments', 'PaymentsController@index')->name('admin.payment.index');
    Route::get('/payment/create', 'PaymentsController@create')->name('admin.payment.create');
    Route::post('/payment', 'PaymentsController@store')->name('admin.payment.store');
    Route::get('/payment/{model}', 'PaymentsController@edit')->name('admin.payment.edit');
    Route::patch('/payment/update/{model}', 'PaymentsController@update')->name('admin.payment.update');
    Route::get('/payment/view/{model}', 'PaymentsController@view')->name('admin.payment.view');

});

Route::get('/payment/{model}', 'HomeController@view')->name('payment.view');
Route::post('/payment/{model}', 'HomeController@pay')->name('payment.pay');
