<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 10/07/16
 * Time: 16:04
 */

namespace Easel\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;
use Proengsoft\JsValidation\JsValidationServiceProvider;

class EaselServiceProvider extends ServiceProvider
{

    /**
     *
     */
    public function boot()
    {
        $this->mergeConfigFrom(EASEL_BASE_PATH . '/config/easel.php', 'blog');

        $this->defineRoutes();
        $this->defineResources();
        $this->defineMigrations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //define package base path
        if ( ! defined('EASEL_BASE_PATH')) {
            define('EASEL_BASE_PATH', realpath(__DIR__ . '/../../'));
        }

        //register service providers
        $this->app->register( JsValidationServiceProvider::class );

        //load facade
        $loader = AliasLoader::getInstance();
        $loader->alias('JsValidator', JsValidatorFacade::class);
    }

    public function provides()
    {
        return [
            JsValidationServiceProvider::class,
        ];
    }

    private function defineRoutes()
    {
        if ( ! $this->app->routesAreCached()) {

            \Route::group([ 'namespace' => 'Easel\Http\Controllers' ],
                function ($router) {
                    require EASEL_BASE_PATH . '/src/Http/routes.php';
                }
            );
        }
    }

    private function defineResources()
    {
        $this->publishes([
            EASEL_BASE_PATH . '/resources/views' => base_path('resources/views/vendor/easel'),
        ]);

        $this->publishes([
            EASEL_BASE_PATH . '/public' => base_path('public')
        ]);
    }

    private function defineMigrations()
    {
        $this->publishes([
            EASEL_BASE_PATH . '/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            EASEL_BASE_PATH . '/database/seeds/' => database_path('seeds')
        ], 'seeds');

        $this->publishes([
            EASEL_BASE_PATH . '/database/factories/' => database_path('factories')
        ], 'factories');

    }
}