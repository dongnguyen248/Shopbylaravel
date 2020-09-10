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

Route::get('/homeAdmin', 'HomeController@index')->name('homeAdmin');

Route::get('/', function () {
    return redirect('/trangchu');
})->name('trang-chu');
Auth::routes();

Route::get('/customerlogin', 'CustomerController@login')->name('customerlogin');
Route::get('/registercustomer', 'CustomerController@register')->name('customerregister');

Route::get('admin-{path}', 'HomeController@index')->where('path', ('[A-Za-z0-9\-]+'));

Route::get('{path}', 'PageController@getIndex')->where('path', '[A-Za-z0-9\-]+', '');