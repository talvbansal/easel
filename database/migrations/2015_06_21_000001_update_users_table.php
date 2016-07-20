<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // When unit testing we need to create a table for users since there will be no users table to alter
        if ( ! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email')->unique()->nullable();
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }

        Schema::table('users', function (Blueprint $table) {

            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->nullable();
            }


            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('last_name')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('display_name')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('url')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->json('social_media')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('address')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('city')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('country')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->text('bio')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('job')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('phone')->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('gender', 140)->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->string('relationship', 140)->nullable();
            }
            if ( ! Schema::hasColumn('users', 'first_name')) {
                $table->date('birthday')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $columns = [
                'first_name',
                'last_name',
                'display_name',
                'url',
                'social_media',
                'address',
                'city',
                'country',
                'bio',
                'job',
                'phone',
                'gender',
                'relationship',
                'birthday'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    //$table->dropColumn( $column );
                }
            }

        });
    }
}
