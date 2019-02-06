<?php

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

//list articles
Route::get('articles', 'ArticleController@index');

//delete article
Route::delete('article/{id}', 'ArticleController@destroy');

//create new article
Route::post('article', 'ArticleController@store');

//update new article
Route::put('article', 'ArticleController@store');

Route::group(['middleware' => 'auth:api'], function () {
    //list single article
    Route::get('article/{id}', 'ArticleController@show');

});

Route::middleware('auth:api')->get('/user', function () {
    dd('salut');
});

//login user
Route::post('login', 'UserController@login');

//register
Route::post('register', 'UserController@register');
