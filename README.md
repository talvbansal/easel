# Easel

### Post require commands
To include the migrations, seeds and factories required for easel run the following three commands

- php artisan vendor:publish --provider="Easel\Providers\EaselServiceProvider" --tag="factories"
- php artisan vendor:publish --provider="Easel\Providers\EaselServiceProvider" --tag="migrations"
- php artisan vendor:publish --provider="Easel\Providers\EaselServiceProvider" --tag="seeds"