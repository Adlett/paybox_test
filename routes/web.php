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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::get('register', 'DashboardController@create')->name('admin.register');
    Route::post('register', 'DashboardController@store')->name('admin.register.store');

    Route::get('login', 'LoginController@login')->name('admin.auth.login');
    Route::post('login', 'LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'LoginController@logout')->name('admin.auth.logout');

    Route::get('/partners', 'PartnerController@index')->name('admin.partner.index');
    Route::get('/partner/create', 'PartnerController@create')->name('admin.partner.create');
    Route::post('/partner', 'PartnerController@store')->name('admin.partner.store');
    Route::delete('/partner/{partner}', 'PartnerController@destroy')->name('admin.partner.delete');
    Route::get('/partner/edit/{partner}', 'PartnerController@edit')->name('admin.partner.edit');
    Route::patch('/partner/update/{partner}', 'PartnerController@update')->name('admin.partner.update');

});
