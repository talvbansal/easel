<?php

/**accessible*/

namespace Easel\Console\Commands;

use Easel\Models\Category;
use Easel\Models\Post;
use Easel\Models\Tag;
use Easel\Providers\EaselServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Proengsoft\JsValidation\JsValidationServiceProvider;
use TalvBansal\MediaManager\Providers\MediaManagerServiceProvider;

/**
 * Class InstallCommand.
 */
class InstallCommand extends Command
{
    /**
     * name of the command.
     *
     * @var string
     */
    protected $signature = 'easel:install';

    /**
     * description of the command.
     *
     * @var string
     */
    protected $description = 'Install easel into the application';

    /**
     * Execute the command.
     */
    public function handle()
    {
        try {
            $this->alert('Setting Up Easel.');

            $this->createConfig();
            $this->publishAssets();
            $this->migrateData();

            $this->createUploadsSymlink();

            // Clear the caches...
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            $this->alert('Easel has been installed.');

        } catch (\Exception $e) {
            $this->error('An unexpected error occurred during the installation.');
            $this->error("✘ {$e->getMessage()}");
        }
    }

    /**
     * create a symlink so that files from storage/app/public can be accessed from public/storage.
     */
    private function createUploadsSymlink()
    {
        $this->warn('Trying to create public folder symlink...');
        try {
            symlink(storage_path('app/public'), public_path('storage'));
            $this->line('<info>✔</info> Symlink created.');
        } catch (\Exception $e) {
            if ($e->getMessage() == 'symlink(): File exists') {
                $this->warn('Symlink already exists.');
            } else {
                $this->line('<error>Unable to create symlink! Your uploaded files may not be accessible.</error>');
            }
        }
    }

    /**
     * copy and create config files into the host project if they don't already exist...
     */
    private function createConfig()
    {
        $this->warn('Copying config files...');
        if (!\File::exists(config_path('easel.php'))) {
            copy(EASEL_BASE_PATH . '/config/easel.php', config_path('easel.php'));
            $this->line('<info>✔</info> Copying Easel config');
        }else{
            $this->warn('Easel config already exists.');
        }

        if (!\File::exists(config_path('scout.php'))) {
            copy(EASEL_BASE_PATH.'/config/scout.php', config_path('scout.php'));
            $this->line('<info>✔</info> Copying laravel scout config');
        }else{
            $this->warn('Laravel scout config already exists.');
        }

        if (!\File::exists(config_path('laravel-backup.php'))) {
            copy(EASEL_BASE_PATH.'/config/laravel-backup.php', config_path('laravel-backup.php'));
            $this->line('<info>✔</info> Copying laravel-backup config.');
        }else{
            $this->warn('Laravel-backup config already exists.');
        }

        $this->line('<info>✔</info> Config files copied.');
    }

    /**
     * publish initial views, css, js, images and database files.
     */
    private function publishAssets()
    {
        $this->warn('Publishing assets...');
        \Artisan::call('vendor:publish', ['--provider' => EaselServiceProvider::class, '--force' => true]);
        \Artisan::call('vendor:publish', ['--provider' => JsValidationServiceProvider::class, '--force' => true, '--tag' => 'public']);
        \Artisan::call('vendor:publish', ['--provider' => MediaManagerServiceProvider::class, '--force' => true, '--tag' => 'media-manager']);
        $this->line('<info>✔</info> Assets published.');
    }

    /**
     * run new migrations and then seed the db.
     */
    private function migrateData()
    {
        $this->warn('Running migrations...');
        $options = [];
        \Artisan::call('migrate', $options);
        $this->line('<info>✔</info> Database updated.');

        \Artisan::call('easel:seed', $options);
        \Artisan::call('scout:import', ['model' => Post::class]);
        \Artisan::call('scout:import', ['model' => Tag::class]);
        \Artisan::call('scout:import', ['model' => Category::class]);
        $this->line('<info>✔</info> Search index files created.');
    }
}
