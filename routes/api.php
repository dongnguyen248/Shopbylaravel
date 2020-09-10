<?php

use Illuminate\Http\Request;

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



Route::get('profile','API\UserController@profile');
Route::post('profile','API\UserController@updateProfile');
Route::post('updateProduct/{id}','API\ProductController@updateProduct');
Route::get('user/filter/{filter}','API\UserController@filterUser');
Route::get('product/filter/{filter}','API\ProductController@filterProduct');
Route::resource('user','API\UserController');
Route::resource('product','API\ProductController');
Route::resource('productUom','API\ProductUomController');
Route::resource('productType','API\ProductTypeController');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });