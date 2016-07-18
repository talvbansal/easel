<?php
/**accessible*/

namespace Easel\Console\Commands;


use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * name of the command
     *
     * @var string
     */
    protected $signature = 'easel:install';

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
        $this->migrateData();

        //finally
        $this->comment('<info>Almost ready! Make sure to make your user model implement Easel\Models\BlogUserInterface!</info>');
        $this->comment('Easel installed. Happy blogging!');
    }

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

    private function createConfig()
    {
        $this->line('Config files created! <info>✔</info>');
        copy( EASEL_BASE_PATH . '/config/easel.php', config_path('easel.php') );
    }

    private function migrateData()
    {

    }
}