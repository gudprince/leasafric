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

Route::get('/guide', function () {
    return view('guide');
});


Route::group(['prefix'  =>  'users'], function () {

    Route::get('/external-users', 'App\Http\Controllers\Api\UserController@external_users');
    Route::post('/', 'App\Http\Controllers\Api\UserController@create');
    Route::get('/', 'App\Http\Controllers\Api\UserController@index');
    Route::delete('/{id}', 'App\Http\Controllers\Api\UserController@destroy');
    Route::get('/{id}', 'App\Http\Controllers\Api\UserController@show');
    Route::put('/{id}', 'App\Http\Controllers\Api\UserController@update');
    Route::get('/{id}/todos', 'App\Http\Controllers\Api\UserController@user_todos');
    Route::get('/{id}/posts', 'App\Http\Controllers\Api\UserController@user_posts');
    Route::get('/{id}/albums', 'App\Http\Controllers\Api\UserController@user_albums');
});

Route::group(['prefix'  =>  'albums'], function () {

    Route::get('/external-albums', 'App\Http\Controllers\Api\AlbumController@external_albums');
    Route::post('/', 'App\Http\Controllers\Api\AlbumController@create');
    Route::get('/', 'App\Http\Controllers\Api\AlbumController@index');
    Route::delete('/{id}', 'App\Http\Controllers\Api\AlbumController@destroy');
    Route::get('/{id}', 'App\Http\Controllers\Api\AlbumController@show');
    Route::put('/{id}', 'App\Http\Controllers\Api\AlbumController@update');
    Route::get('/{id}/photos', 'App\Http\Controllers\Api\AlbumController@album_photos');
});

Route::group(['prefix'  =>  'photos'], function () {

    Route::get('/external-photos', 'App\Http\Controllers\Api\PhotoController@external_photos');
    Route::post('/', 'App\Http\Controllers\Api\PhotoController@create');
    Route::get('/', 'App\Http\Controllers\Api\PhotoController@index');
    Route::delete('/{id}', 'App\Http\Controllers\Api\PhotoController@destroy');
    Route::get('/{id}', 'App\Http\Controllers\Api\PhotoController@show');
    Route::put('/{id}', 'App\Http\Controllers\Api\PhotoController@update');
});

Route::group(['prefix'  =>  'posts'], function () {

    Route::get('/external-posts', 'App\Http\Controllers\Api\PostController@external_posts');
    Route::post('/', 'App\Http\Controllers\Api\PostController@create');
    Route::get('/', 'App\Http\Controllers\Api\PostController@index');
    Route::delete('/{id}', 'App\Http\Controllers\Api\PostController@destroy');
    Route::get('/{id}', 'App\Http\Controllers\Api\PostController@show');
    Route::put('/{id}', 'App\Http\Controllers\Api\PostController@update');
    Route::get('/{id}/comments', 'App\Http\Controllers\Api\PostController@post_comments');
});

Route::get('/external-todos', 'App\Http\Controllers\Api\TodoController@external_todos');
Route::post('/todos', 'App\Http\Controllers\Api\TodoController@create');
Route::get('/todos', 'App\Http\Controllers\Api\TodoController@index');
Route::delete('/todos/{id}', 'App\Http\Controllers\Api\TodoController@destroy');
Route::get('/todos/{id}', 'App\Http\Controllers\Api\TodoController@show');
Route::put('/todos/{id}', 'App\Http\Controllers\Api\TodoController@update');
