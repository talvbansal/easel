<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 18/07/16
 * Time: 14:37.
 */
namespace Easel\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class UpdateCommand extends Command
{
    /**
     * name of the command.
     *
     * @var string
     */
    protected $signature = 'easel:update
                    {--force : Force update Easel overwriting any view changes you might have made}';

    /**
     * description of the command.
     *
     * @var string
     */
    protected $description = 'Update the easel installation';

    /**
     * Execute the command.
     */
    public function handle()
    {
        $this->line ('Updating Easel <info>✔</info>');

        $this->installNewViews ();
        $this->publishAssets ();
        $this->migrateData ();

        $this->comment ('You are now running the latest version of Easel. Enjoy!');
    }

    private function installNewViews()
    {
        $this->line ('Updating views <info>✔</info>');
        $this->getViewsToInstall ()->each (function($view) {
            $this->comment (
                '    ⇒ View [' . $this->relativeViewPath ($view) . '] is new. Installing...'
            );

            $this->createViewDirectoryIfNecessary ($view);

            copy ($view->getRealPath (), $this->publishedViewPath ($view));
        });
        $this->line ('Views updated <info>✔</info>');
    }

    /**
     * Create the view's directory if it doens't exist.
     *
     * @param \SplFileInfo $view
     *
     * @return void
     */
    protected function createViewDirectoryIfNecessary($view)
    {
        if( ! is_dir ($directory = dirname ($this->publishedViewPath ($view)))) {
            (new Filesystem())->makeDirectory (
                $directory, $mode = 0755, $recursive = true
            );
        }
    }

    /**
     * @return Collection
     */
    private function getViewsToInstall()
    {
        $views = collect (
            (new Filesystem())->allFiles (EASEL_BASE_PATH . '/resources/publish')
        );

        if($this->option ('force')) {
            return $views;
        }

        return $views->reject (function($view) {
            return file_exists ($this->publishedViewPath ($view));
        });
    }

    /**
     * Get the view path relative to the views directory.
     *
     * @param \SplFileInfo $view
     *
     * @return string
     */
    protected function relativeViewPath($view)
    {
        $viewPath = str_replace (EASEL_BASE_PATH . '/resources/views/', '', $view->getRealPath ());

        return str_replace (resource_path ('views/vendor/easel/'), '', $viewPath);
    }

    private function publishedViewPath($view)
    {
        return resource_path ('views/vendor/easel/' . $this->relativeViewPath ($view));
    }

    /**
     * publish initial views, css, js, images and database files.
     */
    private function publishAssets()
    {
        $this->line ('Publishing assets...');
        \Artisan::call ('vendor:publish', ['--provider' => 'Easel\\Providers\\EaselServiceProvider', '--force' => true]);
        \Artisan::call ('vendor:publish', [
            '--provider' => 'Proengsoft\\JsValidation\\JsValidationServiceProvider',
            '--force'    => true,
            '--tag'      => 'public'
        ]);
        $this->line ('Assets published! <info>✔</info>');

        exec ('composer dump-autoload');
    }

    /**
     * run new migrations.
     */
    private function migrateData()
    {
        $this->line ('Running migrations...');

        \Artisan::call ('migrate');
        $this->line ('Database updated! <info>✔</info>');
    }
}
