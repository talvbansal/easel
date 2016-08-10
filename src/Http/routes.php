<?php

Route::group(['middleware' => ['web']], function () {
    /*
    |--------------------------------------------------------------------------
    | Blog Routes
    |--------------------------------------------------------------------------
    */
    Route::group([
        'prefix'    => config('easel.blog_base_url'),
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
        // When the user model is needed resolve it from the interface bound in the IOC container that is defined in the service provider
        Route::model('user', \Easel\Models\BlogUserInterface::class);

        Route::resource('admin/post', 'PostController', ['except' => 'show']);
        Route::resource('admin/tag', 'TagController', ['except' => 'show']);
        Route::get('admin/upload', 'UploadController@index');
        Route::post('admin/upload/file', 'UploadController@uploadFile');
        Route::delete('admin/upload/file', 'UploadController@deleteFile');
        Route::post('admin/upload/folder', 'UploadController@createFolder');
        Route::delete('admin/upload/folder', 'UploadController@deleteFolder');

        Route::get('/admin/browser/index', 'FileManagerController@index');
        Route::post('admin/browser/file', 'FileManagerController@uploadFile');
        Route::delete('/admin/browser/delete', 'FileManagerController@deleteFile');
        Route::post('/admin/browser/folder', 'FileManagerController@createFolder');
        Route::delete('/admin/browser/folder', 'FileManagerController@deleteFolder');

        // Profile Routes
        Route::group(['as' => 'admin.profile.'], function () {
            Route::get('admin/profile', 'ProfileController@index')->name('index');
            Route::get('admin/profile/{user}/edit', 'ProfileController@edit')->name('edit');
            Route::put('admin/profile/{user}/update', 'ProfileController@update')->name('update');
            Route::get('admin/profile/{user}/password', 'ProfileController@editPassword')->name('edit.password');
            Route::put('admin/profile/{user}/update-password', 'ProfileController@updatePassword')->name('update.password');
        });

        // Search Routes
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
