<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('categories', 'CategoriesController');
Route::put('categories/{id}/changeStatus','CategoriesController@changeStatus');
Route::resource('products', 'ProductsController');
Route::get('showDiscount','ProductsController@showDiscount');
Route::get('showHot','ProductsController@showHot');
Route::get('showNew','ProductsController@showNew');
Route::resource('customers', 'CustomersController');
Route::resource('bills', 'BillsController');