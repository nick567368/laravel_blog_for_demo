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

Route::get('/', 'BlogController@index');
Route::get('/category/{category_id}', 'BlogController@category');
Route::get('/posts/{post}', 'BlogController@post');
Route::post('/posts/{post}/comment', 'BlogController@comment')->middleware('auth');

Auth::routes();
Route::get('/profile', 'Auth\\ProfileController@index')->middleware('auth');

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('/posts', 'PostController');
    Route::get('/posts/category/{category_id}', 'PostController@category');
    
    Route::put('/posts/{post}/publish', 'PostController@publish')->middleware('auth');
    Route::resource('/categories', 'CategoryController', ['except' => ['show']]);
    Route::resource('/tags', 'TagController', ['except' => ['show']]);
    Route::resource('/comments', 'CommentController', ['only' => ['index', 'destroy']]);
    Route::resource('/users', 'UserController', ['middleware' => 'admin', 'only' => ['index', 'destroy']]);
});