<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 18/07/16
 * Time: 14:37.
 */
namespace Easel\Console\Commands;

use Illuminate\Console\Command;

class UpdateCommand extends Command
{
    /**
     * name of the command.
     *
     * @var string
     */
    protected $signature = 'easel:update';

    /**
     * description of the command.
     *
     * @var string
     */
    protected $description = 'Update the Easel installation';

    /**
     * Execute the command.
     */
    public function handle()
    {
        $this->line('Updating Easel <info>✔</info>');

        $this->publishAssets();
        $this->migrateData();

        $this->comment('You are now running the latest version of Easel. Enjoy!');
    }

    /**
     * publish initial views, css, js, images and database files.
     */
    private function publishAssets()
    {
        $this->line('Publishing assets...');
        \Artisan::call('vendor:publish', ['--provider' => 'Easel\\Providers\\EaselServiceProvider', '--force' => true]);
        \Artisan::call('vendor:publish', ['--provider' => 'TalvBansal\MediaManager\Providers\MediaManagerServiceProvider', '--force' => true]);
        \Artisan::call('vendor:publish', [
            '--provider' => 'Proengsoft\\JsValidation\\JsValidationServiceProvider',
            '--force'    => true,
            '--tag'      => 'public',
        ]);
        $this->line('Assets published! <info>✔</info>');
    }

    /**
     * run new migrations.
     */
    private function migrateData()
    {
        $this->line('Running migrations...');

        \Artisan::call('migrate');
        $this->line('Database updated! <info>✔</info>');

        \Artisan::call('scout:import', ['model' => '\\Easel\\Models\\Post']);
        \Artisan::call('scout:import', ['model' => '\\Easel\\Models\\Tag']);
        $this->line('Search index files updated <info>✔</info>');
    }
}
