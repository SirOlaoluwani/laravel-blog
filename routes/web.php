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
    
    // EVENTS ROUTES
    Route::get('/client/event/create/{id}', 'ClientController@createEvent');
    Route::get('/client/event/edit/{client_id}/{id}', 'ClientController@editEvent');
    Route::post('/client/event/store/{id}', 'ClientController@storeEvents');
    Route::put('/client/event/update/{client_id}/{id}', 'ClientController@updateEvent');
    Route::delete('/client/event/delete/{id}', 'ClientController@deleteEvent');
    Route::put('/client/event/publish/{id}', 'ClientController@publishEvent');
    Route::get('/client/events/{id}', 'ClientController@listEvents');

    //PAST EXHIBITIONS ROUTES
    Route::get('/client/exhibition/create/{id}', 'ClientController@createExhibition');
    Route::get('/client/exhibition/edit/{client_id}/{id}', 'ClientController@editExhibition');
    Route::post('/client/exhibition/store/{id}', 'ClientController@storeExhibition');
    Route::put('/client/exhibition/update/{client_id}/{id}', 'ClientController@updateExhibition');
    Route::delete('/client/exhibition/delete/{id}', 'ClientController@deleteExhibtion');
    Route::put('/client/exhibition/publish/{id}', 'ClientController@publishExhibtion');
    Route::get('/client/exhibitions/{id}', 'ClientController@listExhibitions');

    //WORKS ROUTES
    Route::get('/client/work/create/{id}', 'ClientWorkController@create');
    Route::get('/client/work/edit/{client_id}/{id}', 'ClientWorkController@edit');
    Route::post('/client/work/store/{client_id}', 'ClientWorkController@store');
    Route::put('/client/work/update/{client_id}/{id}', 'ClientWorkController@update');
    Route::delete('/client/work/delete/{id}', 'ClientWorkController@delete');
    Route::get('/client/works/{id}', 'ClientWorkController@index');
    
    Route::put('/clients/${id}', 'ClientController@update');
    Route::put('/clients/{client}/publish', 'ClientController@publish')->middleware('admin');
    
    Route::resource('/categories', 'CategoryController', ['except' => ['show']]);
    Route::resource('/tags', 'TagController', ['except' => ['show']]);
    Route::resource('/comments', 'CommentController', ['only' => ['index', 'destroy']]);
    Route::resource('/users', 'UserController', ['middleware' => 'admin', 'only' => ['index', 'destroy']]);
});