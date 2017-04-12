<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 26/02/17
 * Time: 18:25.
 */

namespace Easel\Console\Commands;

use Easel\Database\Seeds\EaselDatabaseSeeder;
use Illuminate\Console\Command;

class Seed extends Command
{
    /**
     * name of the command.
     *
     * @var string
     */
    protected $signature = 'easel:seed';

    /**
     * description of the command.
     *
     * @var string
     */
    protected $description = 'Migrate and seed the Easel database';

    public function handle()
    {
        $this->warn('Seeding database...');
        $this->call('db:seed', ['--class' => EaselDatabaseSeeder::class]);
        $this->alert('Database seeded.');
    }
}
