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

Route::match(['get', 'post'], '/', function() {
    return redirect('yier');
});

Route::group(['prefix' => 'yier', 'middleware' => 'auth'], function() {
    Route::get('/', 'TestController@test');
    Route::get('/user', 'TestController@test');
    Route::get('/memoryIndex','ShowMemoryController@index')->name('memoryIndex');
    Route::get('/memAdd','ShowMemoryController@memAdd');
    Route::get('/delMem','ShowMemoryController@delMem');
    Route::get('/accountIndex','AccountsCountController@index')->name('accountIndex');
    Route::get('/accountAdd','AccountsCountController@accountAdd');
    Route::get('/delAccount','AccountsCountController@delAccount');

});

Route::auth();


Route::get('/miss', 'TestController@miss');


Route::get('/jd_api', 'TestController@JdApi');

Route::get('/getjdapi', 'TestController@getJdApi');

Route::get('/getCategoryInfo', 'TestController@getCategoryInfo');

Route::get('/getOneJdApi', 'TestController@getOneJdApi');

Route::get('/getCategory', 'TestController@getCategory');

Route::get('/getCategoryAttrValue', 'TestController@getCategoryAttrValue');

