<?php

namespace Easel\Database\Seeds;

use Illuminate\Database\Seeder;

/*
|--------------------------------------------------------------------------
| Initial User Seed Data
|--------------------------------------------------------------------------
|
| Here you may set the user information details for the application
| administrator. Don't worry, you can always edit these
| details within the application.
|
*/

class UsersTableSeeder extends Seeder
{
    /**
     * Run the User model database seed.
     *
     * @return void
     */
    public function run()
    {
        $users = \DB::table('users');
        $users->truncate();

        $users->insert([
            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */
            'name'         => 'Easel',
            'first_name'   => 'Easel',
            'last_name'    => 'Administrator',
            'display_name' => 'Admin',
            'job'          => 'Web Developer',

            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */
            'email'        => 'admin@'.seoUrl(config('easel.name')).'.com',
            'social_media' => json_encode([
                'twitter'  => 'https://twitter.com/'.seoUrl(config('easel.name')),
                'facebook' => 'https://facebook.com/'.seoUrl(config('easel.name')),
                'github'   => 'https://github.com/'.seoUrl(config('easel.name')),
            ]),
            'city'         => 'Birmingham',
            'country'      => 'UK',

            /*
            |--------------------------------------------------------------------------
            | Misc Information
            |--------------------------------------------------------------------------
            */
            'url'          => 'www.'.seoUrl(config('easel.name')).'.com',
            'password'     => bcrypt('password'),

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */
            'created_at'   => \Carbon\Carbon::now(),
            'updated_at'   => \Carbon\Carbon::now(),
        ]);
    }
}
