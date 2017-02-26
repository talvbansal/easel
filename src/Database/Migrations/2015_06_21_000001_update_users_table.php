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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email')->unique()->nullable();
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable()->change();
            }

            if (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->nullable();
            }

            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'display_name')) {
                $table->string('display_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'url')) {
                $table->string('url')->nullable();
            }
            if (!Schema::hasColumn('users', 'first_name')) {
                $table->json('social_media')->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('users', 'country')) {
                $table->string('country')->nullable();
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('users', 'job')) {
                $table->string('job')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 140)->nullable();
            }
            if (!Schema::hasColumn('users', 'relationship')) {
                $table->string('relationship', 140)->nullable();
            }
            if (!Schema::hasColumn('users', 'birthday')) {
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
        Schema::dropIfExists('users');
    }
}
