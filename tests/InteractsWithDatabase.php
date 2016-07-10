<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

trait InteractsWithDatabase
{

    use DatabaseTransactions;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp() {

        parent::setUp();

        $this->runDatabaseMigrations();

        $this->seed(TestDatabaseSeeder::class);

    }

    /**
     * Define hooks to migrate the database before and after each test.
     *
     * @return void
     */
    public function runDatabaseMigrations()
    {
        $this->artisan('migrate');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:reset');
        });
    }

}