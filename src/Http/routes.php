<?php

Route::group(['middleware' => ['web']], function () {

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

        Route::group(['as' => 'admin.'], function () {
            Route::resource('admin/category', 'CategoryController', ['except' => 'show']);
            Route::resource('admin/post', 'PostController', ['except' => 'show']);
            Route::resource('admin/search', 'SearchController');
            Route::resource('admin/tag', 'TagController', ['except' => 'show']);
            Route::resource('admin/user', 'UserController', ['except' => 'show']);
        });

        // Media Manager Routes
        Route::get('admin/media', 'MediaController@index')->name('admin.media.index');
        \TalvBansal\MediaManager\Routes\MediaRoutes::get();

        // Profile Routes
        Route::group(['as' => 'admin.profile.'], function () {
            Route::get('admin/profile', 'ProfileController@index')->name('index');
            Route::get('admin/profile/{user}/edit', 'ProfileController@edit')->name('edit');
            Route::put('admin/profile/{user}/update', 'ProfileController@update')->name('update');
            Route::get('admin/profile/{user}/password', 'ProfileController@editPassword')->name('edit.password');
            Route::put('admin/profile/{user}/update-password', 'ProfileController@updatePassword')->name('update.password');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Logging In/Out Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/login', 'Auth\LoginController@getLogin');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/logout', 'Auth\LoginController@logout');
});
