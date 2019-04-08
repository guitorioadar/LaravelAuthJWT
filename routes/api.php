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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('posts')->group(function () {



//    Route::post('create', ['as' => 'post.create', 'uses' => 'Api\PostController@create']);

//    Route::get('self', [
//        'as' => 'post.self',
//        'uses' => 'Api\PostController@self'
//    ]);

});

Route::post('login','Api\Auth\ApiAuthController@login');
Route::post('register','Api\Auth\ApiAuthController@register');
Route::get('posts/all','Api\PostController@all');

Route::group(['middleware' => 'auth.jwt',], function () {

    Route::get('logout', 'Api\Auth\ApiAuthController@logout');

    Route::get('user', 'Api\Auth\ApiAuthController@getAuthUser');

    Route::post('posts/', 'Api\PostController@index');
    Route::post('posts/create', 'Api\PostController@create');
    Route::get('posts/self', 'Api\PostController@self');
    Route::get('posts/{id}', 'Api\PostController@show');
    Route::put('posts/{id}', 'Api\PostController@update');
    Route::delete('posts/{id}', 'Api\PostController@destroy');

});