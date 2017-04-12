<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 18/07/16
 * Time: 14:37.
 */

namespace Easel\Console\Commands;

use Easel\Models\Category;
use Easel\Models\Post;
use Easel\Models\Tag;
use Easel\Providers\EaselServiceProvider;
use Illuminate\Console\Command;
use Proengsoft\JsValidation\JsValidationServiceProvider;

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
        $this->alert('Updating Easel.');

        $this->publishAssets();
        $this->migrateData();

        $this->alert('You are now running the latest version of Easel. Enjoy!');
    }

    /**
     * publish initial views, css, js, images and database files.
     */
    private function publishAssets()
    {
        $this->warn('Publishing assets...');
        \Artisan::call('vendor:publish', ['--provider' => EaselServiceProvider::class, '--force' => true]);
        \Artisan::call('vendor:publish', [
            '--provider' => JsValidationServiceProvider::class,
            '--force'    => true,
            '--tag'      => 'public',
        ]);
        $this->line(' <info>✔</info> Assets published.');
    }

    /**
     * run new migrations.
     */
    private function migrateData()
    {
        $this->warn('Running migrations...');

        \Artisan::call('migrate');
        $this->line(' <info>✔</info> Database updated.');

        \Artisan::call('scout:import', ['model' => Post::class]);
        \Artisan::call('scout:import', ['model' => Tag::class]);
        \Artisan::call('scout:import', ['model' => Category::class]);
        $this->line(' <info>✔</info> Search index files updated.');
    }
}
