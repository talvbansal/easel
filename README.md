# Easel

### Post require commands
To include the migrations, seeds and factories required for easel run the following command to publish all the required assets, migration and seed files
- php artisan vendor:publish --provider="Easel\Providers\EaselServiceProvider"
 
To migrate and seed the database run the following command
- php artisan migrate --seed
 
You will need to add the Easel service provider to you config/app.php file
- \Easel\Providers\EaselServiceProvider::class,

You'll also need to make your User model implement the "Easel\Models\BlogUserInterface"