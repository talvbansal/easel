<?php
/**accessible*/

namespace Easel\Console\Commands;


use Illuminate\Console\Command;

/**
 * Class InstallCommand
 * @package Easel\Console\Commands
 */
class InstallCommand extends Command
{
    /**
     * name of the command
     *
     * @var string
     */
    protected $signature = 'easel:install
        {--seed : Seed the database when installing}
    ';

    /**
     * description of the command
     *
     * @var string
     */
    protected $description = 'Install easel into the application';

    /**
     * Execute the command
     */
    public function handle()
    {
        $this->line('Setting Up Easel <info>✔</info>');

        $this->createConfig();
        $this->createUploadsSymlink();
        $this->publishAssets();
        $this->migrateData();

        //finally
        $this->comment('<info>Almost ready! Make sure to make your user model implements Easel\Models\BlogUserInterface!</info>');
        $this->comment('Easel installed. Happy blogging!');
    }

    /**
     * create a symlink so that files from storage/app/public can be accessed from public/storage
     */
    private function createUploadsSymlink()
    {
        $this->line('Trying to create public folder symlink...');
        try {
            symlink(storage_path('app/public'), public_path('storage'));
            $this->line('Symlink created! <info>✔</info>');
        } catch (\Exception $e) {
            //the symlink creation failed, maybe it already exists
            if ($e->getMessage() == "symlink(): File exists") {
                $this->line('Symlink already exists! <info>✔</info>');
            } else {
                $this->line('<error>Unable to create symlink! Your uploaded files may not be accessible.</error>');
            }
        }
    }

    /**
     * copy config file into main project
     */
    private function createConfig()
    {
        $this->line('Config files created! <info>✔</info>');
        copy( EASEL_BASE_PATH . '/config/easel.php', config_path('easel.php') );
    }

    /**
     * publish initial views, css, js, images and database files
     */
    private function publishAssets()
    {
        $this->line('Publishing assets...');
        \Artisan::call('vendor:publish', ['--provider' => "Easel\\Providers\\EaselServiceProvider", '--force' => true] );
        $this->line('Assets published! <info>✔</info>');
    }

    /**
     * run new migrations and then seed the db
     */
    private function migrateData()
    {
        $this->line('Running migrations...');

        $options = [];
        if( $this->option('seed') ){
            $options['--seed'] = true;

        }

        \Artisan::call('migrate', $options );
        $this->line('Database updated! <info>✔</info>');

        if( $this->option('seed') ) {
            $this->line('Database seeded! <info>✔</info>');
        }else{
            $this->comment('The database was not seeded make sure you create your user manually');
        }
    }

    /**
     * check if easel is in the composer
     * @return bool
     */
    private function hasEaselBeenInstalled()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        return isset($composer['require']['talv86/easel']);
    }


}