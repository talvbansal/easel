<?php

/**accessible*/

namespace Easel\Console\Commands;

use Easel\Models\Post;
use Easel\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
    protected $signature = 'easel:install
    ';

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
        $this->line('Setting Up Easel <info>✔</info>');

        $this->createConfig();
        $this->publishAssets();
        $this->migrateData();

        $this->createUploadsSymlink();
        //finally
        $this->comment('<info>Almost ready! Make sure to make your user model implements Easel\Models\BlogUserInterface!</info>');
        $this->comment('Easel installed! please run php artisan db:seed to complete the installation');
    }

    /**
     * create a symlink so that files from storage/app/public can be accessed from public/storage.
     */
    private function createUploadsSymlink()
    {
        $this->line('Trying to create public folder symlink...');
        try {
            symlink(storage_path('app/public'), public_path('storage'));
            $this->line('Symlink created! <info>✔</info>');
        } catch (\Exception $e) {
            //the symlink creation failed, maybe it already exists
            if ($e->getMessage() == 'symlink(): File exists') {
                $this->line('Symlink already exists! <info>✔</info>');
            } else {
                $this->line('<error>Unable to create symlink! Your uploaded files may not be accessible.</error>');
            }
        }
    }

    /**
     * copy config file into main project.
     */
    private function createConfig()
    {
        copy(EASEL_BASE_PATH.'/config/easel.php', config_path('easel.php'));
        $this->line('Copying Easel Config <info>✔</info>');
        copy(EASEL_BASE_PATH.'/config/scout.php', config_path('scout.php'));
        $this->line('Copying Scout Config! <info>✔</info>');

        $this->line('Config files created! <info>✔</info>');
    }

    /**
     * publish initial views, css, js, images and database files.
     */
    private function publishAssets()
    {
        $this->line('Publishing assets...');
        \Artisan::call('vendor:publish', ['--provider' => 'Easel\\Providers\\EaselServiceProvider', '--force' => true]);
        \Artisan::call('vendor:publish', ['--provider' => 'Proengsoft\\JsValidation\\JsValidationServiceProvider', '--force' => true, '--tag' => 'public']);
        $this->line('Assets published! <info>✔</info>');
    }

    /**
     * run new migrations and then seed the db.
     */
    private function migrateData()
    {
        $this->line('Running migrations...');
        $options = [];
        \Artisan::call('migrate', $options);
        $this->line('Database updated! <info>✔</info>');
        $this->appendSeederToMasterFile();

        \Artisan::call('scout:import', ['model' => '\\Easel\\Models\\Post']);
        \Artisan::call('scout:import', ['model' => '\\Easel\\Models\\Tag']);
        $this->line('Search index files created <info>✔</info>');

        @system('composer dump');
    }

    private function appendSeederToMasterFile()
    {
        $seeder = base_path('database/seeds/DatabaseSeeder.php');
        $addition = '$this->call("EaselDatabaseSeeder");';

        //Not sure the best way to do this
        if (file_exists($seeder)) {
            $current_contents = file_get_contents($seeder);
            //Only add the seeder in if it doesn't already exist
            if(  strpos($current_contents, $addition) !== false ) {
                $magic = '/((?:.|\s)*?\s*run\(\)\s*{)((?:.|\s)*)(}\s*})$/m';
                preg_match($magic, $current_contents, $matches);
                $new_content = $matches[1] . $matches[2] . "\n\t\t" . $addition . "\n\t" . $matches[3];

                return file_put_contents($seeder, $new_content);
            }
        }

        return false;

    }
}
