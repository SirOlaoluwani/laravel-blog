<?php

Route::post('/auth/token', 'Api\AuthController@getAccessToken');
Route::post('/auth/reset-password', 'Api\AuthController@passwordResetRequest');
Route::post('/auth/change-password', 'Api\AuthController@changePassword');

Route::group(['middleware' => 'api', 'namespace' => 'Api'], function () {
    Route::get('/tags', 'ListingController@tags');
    Route::get('/categories', 'ListingController@categories');
    // Route::get('/users', 'ListingController@users')->middleware('admin');


    Route::resource('/community-works', 'CommunityWorksController', ['only' => ['index']]);
    Route::get('/community-works/{communityWork}', 'CommunityWorksController@show');
    
    Route::resource('/clients', 'ClientController', ['only' => ['index']]);
    Route::get('/clients/{client}', 'ClientController@show');
    Route::get('/clients/{client}/{client_uuid}', 'ClientController@showWithGallery');
    Route::get('/client/gallery/{client}', 'ClientController@showGallery');
    Route::post('/client/request-more-mail/{client_uuid}', 'ClientController@sendRequestMoreDetailsMail');
    
    Route::resource('/posts', 'PostController', ['only' => ['index', 'show']]);
});
