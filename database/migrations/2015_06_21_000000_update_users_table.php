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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name');
            $table->string('url')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('github')->nullable();
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
            $table->string('name');

            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('display_name');
            $table->dropColumn('url');
            $table->dropColumn('twitter');
            $table->dropColumn('facebook');
            $table->dropColumn('github');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('bio');
            $table->dropColumn('job');
            $table->dropColumn('phone');
            $table->dropColumn('gender', 140);
            $table->dropColumn('relationship', 140);
            $table->dropColumn('birthday');
        });
    }
}
