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

        // Media Manager Routes
        Route::get('/admin/media', 'MediaController@index');
        Route::get('/admin/browser/index', 'MediaController@ls');
        Route::post('admin/browser/file', 'MediaController@uploadFiles');
        Route::delete('/admin/browser/delete', 'MediaController@deleteFile');
        Route::post('/admin/browser/folder', 'MediaController@createFolder');
        Route::delete('/admin/browser/folder', 'MediaController@deleteFolder');
        Route::post('/admin/browser/rename', 'MediaController@rename');
        Route::get('/admin/browser/directories', 'MediaController@allDirectories');
        Route::post('/admin/browser/move', 'MediaController@move');

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
