<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            Schema::create('users', function ( Blueprint $table ) {
                $table->increments('id');
                $table->string('email')->unique()->nullable();
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
        }

        Schema::table('users', function (Blueprint $table) {

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('url')->nullable();
            $table->json('social_media')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->text('bio')->nullable();
            $table->string('job')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender', 140)->nullable();
            $table->string('relationship', 140)->nullable();
            $table->date('birthday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function( Blueprint $table ){

            $columns = ['first_name', 'last_name', 'display_name', 'url', 'social_media', 'address', 'city', 'country', 'bio', 'job', 'phone', 'gender', 'relationship', 'birthday'];

            foreach ($columns as $column )
            {
                if( Schema::hasColumn('users', $column) )
                {
                    //$table->dropColumn( $column );
                }
            }

        });
    }
}
