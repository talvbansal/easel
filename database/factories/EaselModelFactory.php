<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*
|--------------------------------------------------------------------------
| Posts Model Factory
|--------------------------------------------------------------------------
|
| Create the Welcome post in the database.
|
*/
$factory->define(Easel\Models\Post::class, function ($faker) {
  return [
    'title'             => 'Hello world',
    'subtitle'          => 'Canvas is a minimal blogging application for developers. Canvas attempts to make blogging simple and enjoyable by utilizing the latest technologies and keeping the administration as simple as possible with the primary focus on writing.',
    'page_image'        => 'placeholder.png',
    'content_raw'       => view('vendor.easel.shared.helpers.welcome'),
    'published_at'      => Carbon\Carbon::now(),
    'meta_description'  => 'Let\'s get you up and running with Canvas!',
    'is_draft'          => false,
  ];
});

/*
|--------------------------------------------------------------------------
| Tags Model Factory
|--------------------------------------------------------------------------
|
| Create tags for the Welcome post in the database.
|
*/
$factory->define(Easel\Models\Tag::class, function ($faker) {
  return [
    'tag'               => 'Getting Started',
    'title'             => 'Getting Started',
    'subtitle'          => 'Getting started with Canvas',
    'meta_description'  => 'Meta content for this tag.',
    'reverse_direction' => false,
    'created_at'        => Carbon\Carbon::now(),
  ];
});

/*
|--------------------------------------------------------------------------
| User Model Factory
|--------------------------------------------------------------------------
|
| Create a user model in the database.
|
*/
$factory->define(Easel\Models\User::class, function(Faker\Generator $faker) {

    return [
        'first_name'    => $first = $faker->firstName,
        'last_name'     => $last = $faker->lastName,
        'display_name'  => $first . ' ' . $last,
        'job'           => $faker->jobTitle,
        'birthday'      => $faker->date('Y-m-d'),
        'email'         => $faker->safeEmail,
        'social_media'  => json_encode(['twitter' => $faker->userName, 'facebook' => $faker->userName ]),
        'address'       => $faker->streetAddress,
        'city'          => $faker->city,
        'country'       => $faker->countryCode,
        'url'           => $faker->url,
        'password'      => bcrypt('password'),

    ];
});