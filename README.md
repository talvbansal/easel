# Easel
#### A minimal blogging package for laravel apps

[![Build Status](https://api.travis-ci.org/talv86/easel.svg)](https://travis-ci.org/talv86/easel)
[![Issues](https://img.shields.io/github/issues/talv86/easel.svg)](https://github.com/talv86/easel/issues)
[![Downloads](https://poser.pugx.org/talv86/easel/downloads)](https://packagist.org/packages/talv86/easel)
[![License](https://github.com/talv86/easel/blob/master/LICENSE)](https://poser.pugx.org/talv86/easel/license)

### Installation

1. You can download Easel using composer 

    ```
    composer require talv86/easel
    ```

2. To register the easy install and update commands as well as registering the new routes for Easel to work, you will need to add the Easel service provider to you `config/app.php` file

    ```
    \Easel\Providers\EaselServiceProvider::class,
    ```

3. To install Easel into your project run the following command, this will publish all the application assets and database migrations / factories / seeds required, the migrations will automatically be run from this command

    ```
    php artisan easel:install
    ```

4. Finally you'll need to seed your database to create the default admin user and initial post

    ```
    php artisan db:seed
    ```

5. Sign into Easel using the default credentials:
    - Email `admin@easel.com`
    - Password `password`
    
6. Head over to the profile page and update your details and password!

7. Start blogging! 

### Updates 

- Whenever an update to Easel is made internal files will automatically be updated when a composer update is run, however new views and assets will only be published / republished with the following command
    
        php artisan easel:update
    
- You could also add the above command to your post-update-cmd in your projects `composer.json` file

        "post-update-cmd": [
            "Illuminate\\Foundation\\ComposerScripts::postUpdate",
            "php artisan easel:update",
            "php artisan optimize"
        ]

### User Models

- Easel allows you to use the built in user model (`Easel\Models\User`) or you can use your own custom model. 

#### Build In Model

- If you want to use the build in User model (`Easel\Models\User`) you'll need to set it in the config/auth.php file

        'providers' => [
            'users' => [
                'driver' => 'eloquent',
                'model' => Easel\Models\User::class,
            ],
        ],
    

#### Custom Model

If you want to use an existing model you'll need to make the following changes to it: 

1. Your User model will need implement the "Easel\Models\BlogUserInterface" and also use the "Easel\Models\EaselUserTrait"
2. You will also need to add the key 'birthday' to the $dates property of your user model

        class User extends Model implements \Easel\Models\BlogUserInterface{
        
            use Easel\Models\EaselUserTrait;
        
            protected $dates = ['birthday'];
            
        }
    
3. Then finally update the `config/easel.php` config file use your User model
 
    ```
    'user_model' => \My\Custom\User::class,
    ```
    

### Customising the url prefix for the blog

By default you can access the blog list and posts at the following routes:
    
        /blog
        /blog/{blog-post-slug}
    
However you might want the blog to accessed from a different URI, Easel lets you configure that by adding the following key `BLOG_BASE_URL` to your `.env` file, for example:

        BLOG_BASE_URL=/myblog
   
The above changes will make your blog respond at 
    
        /myblog
        /myblog/{blog-post-slug}

If you want the blog to respond at the `'/'` route you will need to add a new route to your `routes.php` file as follows:

        Route::get('/', '\Easel\Http\Controllers\Frontend\BlogController@index');

### Setting a views folder for your blog posts

When creating a blog post you can use the `default` layout for Easel, however it is likely that you'll want to amend the views to suit your application. 
You may also need different views for different blog posts - Easel has you covered! just add the `BLOG_POST_LAYOUTS` key to your `.env` file and give it the path to a folder within your `resources/views` folder

For example

        BLOG_POST_LAYOUTS=layouts.posts

Will point to the following folder

        {project}/resources/views/layouts/posts

 - Every blade template within that folder will then be listed on the post creation page as a potential layout for that post. 
 - Sub-folders within the `BLOG_POST_LAYOUTS` folder will __not__ be listed allowing you to store partials for your templates within that single folder structure.

