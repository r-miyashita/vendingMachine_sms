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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/purchase/{id}', 'API\SalesController@purchase');

Route::group(['middleware' => ['api', 'cors']], function(){
    Route::get('/index', 'API\ApiController@index');
    Route::get(
        '/search/{keyword?}/{filter?}/{minPrice?}/{maxPrice?}/{minStock?}/{maxStock?}',
        'API\ApiController@getSearchResult'
    );
    Route::get('/create', 'API\ApiController@showCreateForm');
    Route::options('/create', function () {
        return response()->json();
    });
    Route::post('/create', 'API\ApiController@create');
    Route::options('/update/{id}', function () {
        return response()->json();
    });
    Route::post('/update/{id}', 'API\ApiController@update');
    Route::options('/destroy/{id}', function () {
        return response()->json();
    });
    Route::post('/destroy/{id}', 'API\ApiController@destroy');
});
