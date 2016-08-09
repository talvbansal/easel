# Easel
#### A minimal blogging package for laravel apps
<hr>

[![Build Status](https://api.travis-ci.org/talv86/easel.svg)](https://travis-ci.org/talv86/easel)
[![Issues](https://img.shields.io/github/issues/talv86/easel.svg)](https://github.com/talv86/easel/issues)
[![Downloads](https://poser.pugx.org/talv86/easel/downloads)](https://packagist.org/packages/talv86/easel)

### Installation
<hr>

Require this package with composer

```
composer require talv86/easel
```

To register the easy install and update commands as well as registering the new routes for Easel to work, you will need to add the Easel service provider to you config/app.php file
```
\Easel\Providers\EaselServiceProvider::class,
```

To install Easel into your project run the following command, this will publish all the application assets and database migrations / factories / seeds required, the migrations will automatically be run from this command

```
php artisan easel:install
```

Finally you'll need to seed your database to create the default admin user and initial post

```
php artisan db:seed
```

Whenever an update to easel is made internal files will automatically be updated when a composer update is run, however new views and assets will only be published / republished with the following command
```
php artisan easel:update
```
You could also add the above command to your post-update-cmd in your projects composer.json file


### User Models
<hr>

Easel allows you to use the built in user model which is Easel\Models\User or you can use your own custom model. 

#### Build In Model
If you want to use the build in User model you'll need to set it in the config/auth.php file

```
'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Easel\Models\User::class,
        ],
    ],
```

#### Custom Model

If you want to use an existing model you'll need to make the following changes to it: 

Your User model will need implement the "Easel\Models\BlogUserInterface" and also use the "Easel\Models\EaselUserTrait" 
You will also need to add the key 'birthday' to the $dates property of your user model
```
class User extends Model implements \Easel\Models\BlogUserInterface{

    use Easel\Models\EaselUserTrait;

    protected $dates = ['birthday'];
}
```
Then finally update the config/easel.php config file use your User model

```
'user_model' => \My\Custom\User::class,
```

### Customising the url prefix for the blog
<hr>

By default you can access the public blog listing at the following routes:
```
/blog
/blog/{blog-post-slug}
````
You might want the blog to accessed from a different URI.
Easel lets you configure that by adding the following key to your .env file BLOG_BASE_URL

For example

```
BLOG_BASE_URL=/myblog
```
Will make your blog respond at 
```
/myblog
/myblog/{blog-post-slug}
```

If you want the blog to respond at the '/' route you will need to add a new route to your routes.php file as follows:
```
Route::get('/', '\Easel\Http\Controllers\Frontend\BlogController@index');
```

### Setting a views folder for your blog posts
<hr>

When creating a blog post you can use the default layout for easel, however it is likely that you'll want to amend the views to suit your application. 
You may also need different views for different blog posts, easel has you covered just add a new key to your .env file called BLOG_POST_LAYOUTS. then give it the path to a folder within your resources/views folder

For example

```
BLOG_POST_LAYOUTS=layouts.posts
```

Will point to the following folder

```
{project}/resources/views/layouts/posts
```

Every blade template within that folder will then be listed on the post creation page as a potential layout for that post. Subfolders within the BLOG_POST_LAYOUTS folder will not be listed allowing you to store partials for your templates within a single folder.

