# Easel
#### A minimal blogging package for laravel apps

[![Build Status](https://api.travis-ci.org/talv86/easel.svg)](https://travis-ci.org/talv86/easel)

### Post install commands
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
 
You will need to add the Easel service provider to you config/app.php file
```
\Easel\Providers\EaselServiceProvider::class,
```

### User Models
Easel allows you to use the built in user model which is Easel\Models\User or you can use your own custom model. If you want to use your own model you'll need to make the following changes: 

You will also need to make your User model implement the "Easel\Models\BlogUserInterface" 
You will also need to add the key 'birthday' to the $dates property of your user model
```
class User extends Model implements \Easel\Models\BlogUserInterface{
    protected $dates = ['birthday'];
}
```

### Setting a views folder for your blog posts
When creating a blog post you can use the default layout for easel but that probably won't fit in with you existing application. 
You may also need different views for different blog posts, easel has you covered just add a new key to your .env file called POST_LAYOUTS. then give it the path to a folder within your resources/views folder

For example

```
POST_LAYOUTS=layouts.posts
```

Will point to the following folder

```
{project}/resources/views/layouts/posts
```

Every blade template within that folder will then be listed on the post creation page as a potential layout for that post. Subfolders within the POST_LAYOUTS folder will not be listed allowing you to store partials for your templates within a single folder.

