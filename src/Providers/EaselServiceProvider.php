<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 10/07/16
 * Time: 16:04
 */

namespace Easel\Providers;

use Illuminate\Support\ServiceProvider;

class EaselServiceProvider extends ServiceProvider
{

    public function boot(){

        $this->defineRoutes();
        $this->defineResources();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ( ! defined('EASEL_BASE_PATH')) {
            define('EASEL_BASE_PATH', realpath(__DIR__ . '/../../'));
        }
    }

    private function defineRoutes()
    {
        if ( ! $this->app->routesAreCached()) {

            \Route::group(['namespace' => 'Easel\Http\Controllers'],
                function( $router ){
                    require EASEL_BASE_PATH . '/src/Http/routes.php';
                }
            );
        }
    }

    private function defineResources()
    {
    }
}