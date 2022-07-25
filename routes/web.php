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
Route::get('/products_list', 'ProductController@showProductsList')->name('products_list');
Route::get('/register_product', 'ProductController@registerProduct')->name('product.register');
Route::get('/product_detail{id}', 'ProductController@showDetail')->name('product.detail');
Route::get('/product_edit{id}', 'ProductController@getEdit')->name('product.get.edit');

Route::post('/destroy{id}', 'ProductController@destroy')->name('product.destroy');
Route::post('/register_product', 'ProductController@create')->name('product.create');
Route::post('/product_edit{id}', 'ProductController@update')->name('product.update');
