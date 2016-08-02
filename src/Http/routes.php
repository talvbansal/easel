<?php

Route::group(['middleware' => ['web']], function () {
    /*
    |--------------------------------------------------------------------------
    | Blog Routes
    |--------------------------------------------------------------------------
    */
    Route::group([
        'prefix' => config('easel.blog_base_url'),
        'namespace' => 'Frontend',
    ], function () {
        Route::get('/', 'BlogController@index');
        Route::get('/{slug}', 'BlogController@showPost');
        Route::get('/author/{id}', 'BlogController@showPostsByAuthor');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::get('admin', function () {
        return redirect('/admin/post');
    });
    Route::group([
        'namespace'  => 'Backend',
        'middleware' => 'auth',
    ], function () {
        Route::resource('admin/post', 'PostController', ['except' => 'show']);
        Route::resource('admin/tag', 'TagController', ['except' => 'show']);
        Route::get('admin/upload', 'UploadController@index');
        Route::post('admin/upload/file', 'UploadController@uploadFile');
        Route::delete('admin/upload/file', 'UploadController@deleteFile');
        Route::post('admin/upload/folder', 'UploadController@createFolder');
        Route::delete('admin/upload/folder', 'UploadController@deleteFolder');
        Route::resource('admin/profile', 'ProfileController');
        Route::resource('admin/search', 'SearchController');
    });

    /*
    |--------------------------------------------------------------------------
    | Logging In/Out Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
    Route::get('/logout', 'Auth\AuthController@getLogout');
});
