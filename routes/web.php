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

Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('/', 'PostController');
});

Auth::routes(['register' => false]);
Route::get('/profile', 'Auth\\ProfileController@index')->middleware('auth');

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('/posts', 'PostController');
    Route::put('/posts/{post}/publish', 'PostController@publish')->middleware('admin');
    
    Route::resource('/community-works', 'CommunityWorksController');
    Route::get('/community-works/${id}', 'CommunityWorksController@show');
    Route::put('/community-works/${id}', 'CommunityWorksController@update');
    Route::put('/community-works/{communityWorks}/publish', 'CommunityWorksController@publish')->middleware('admin');
    
    Route::resource('/clients', 'ClientController');
    Route::post('/clients', 'ClientController@store');
    Route::get('/clients/${id}', 'ClientController@show');
    Route::get('/client/works/{id}', 'ClientController@works');
    Route::get('/client/link', 'ClientController@generateClientLink');
    Route::get('/client/delete-gallery', 'ClientController@deleteGallery');
    
    Route::put('/clients/${id}', 'ClientController@update');
    Route::put('/clients/{client}/publish', 'ClientController@publish')->middleware('admin');
    
    Route::resource('/categories', 'CategoryController', ['except' => ['show']]);
    Route::resource('/tags', 'TagController', ['except' => ['show']]);
    Route::resource('/comments', 'CommentController', ['only' => ['index', 'destroy']]);
    Route::resource('/users', 'UserController', ['middleware' => 'admin', 'only' => ['index', 'destroy']]);
});
