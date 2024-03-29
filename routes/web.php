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

// ★一覧
Route::get('/list', 'ProductsController@showList')->name('product.list');
Route::get('/list/search/{keyword?}/{filter?}/{minPrice?}/{maxPrice?}/{minStock?}/{maxStock?}', 
           'ProductsController@getSearchResult'
          )->name('product.list.search');

// ★登録
Route::get('/create', 'ProductsController@showCreateForm')->name('product.create.get');
Route::post('/create', 'ProductsController@create')->name('product.create');

// ★詳細
Route::get('/detail/{id}', 'ProductsController@showDetail')->name('product.detail');

// ★編集
Route::get('/update/{id}', 'ProductsController@showUpdateForm')->name('product.update.get');
Route::post('/update/{id}', 'ProductsController@update')->name('product.update');

// ★削除
Route::post('/destroy/{id}', 'ProductsController@destroy')->name('product.destroy');


