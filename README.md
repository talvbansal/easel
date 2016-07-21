# Easel
#### A minimal blogging package for laravel apps

[![Build Status](https://api.travis-ci.org/talv86/easel.svg)](https://travis-ci.org/talv86/easel)

### Post install commands

To register the easy install and update commands as well as registering the new routes for Easel to work, you will need to add the Easel service provider to you config/app.php file
```
\Easel\Providers\EaselServiceProvider::class,
```

To include the migrations, seeds and factories required for easel run the following command to publish all the required assets, migration and seed files
```
php artisan easel:install --seed
```
The optional seed parameter will seed your database
 
Whenever an update to easel is made internal files will automatically be updated when a composer update is run, however new views and assets will only be republished with the following command
```
php artisan easel:update --force
```
The optional force parameter will overwrite any views that have already been published


### User Models
Easel allows you to use the built in user model which is Easel\Models\User or you can use your own custom model. If you want to use your own model you'll need to make the following changes: 

You will also need to make your User model implement the "Easel\Models\BlogUserInterface" 
You will also need to add the key 'birthday' to the $dates property of your user model
```
class User extends Model implements \Easel\Models\BlogUserInterface{
    protected $dates = ['birthday'];
}
```

### Customising the url prefix for the blog
By default you can access the public blog listing at the following routes:
```
/blog
/blog/{blog-post-slug}
```
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

