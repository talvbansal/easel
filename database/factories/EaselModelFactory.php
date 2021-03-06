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
$factory->define(Easel\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'title'               => 'Hello world',
        'slug'                => 'hello-world',
        'subtitle'            => 'Easel is a blogging package for Laravel',
        'page_image'          => '/storage/placeholder.png',
        'content_raw'         => view('easel::shared.helpers.welcome'),
        'published_at'        => Carbon\Carbon::now(),
        'meta_description'    => 'Let\'s get you up and running with Easel!',
        'is_draft'            => false,
        'layout'              => config('easel.layouts.posts.default'),
        'author_id'           => 1,
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
$factory->define(Easel\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'tag'               => 'Getting Started',
        'title'             => 'Getting Started',
        'subtitle'          => 'Getting started with Easel',
        'meta_description'  => 'Meta content for this tag.',
        'layout'            => 'vendor.easel.frontend.blog.index',
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
$factory->define(Easel\Models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name'   => $first = $faker->firstName,
        'last_name'    => $last = $faker->lastName,
        'display_name' => $first.' '.$last,
        'job'          => $faker->jobTitle,
        'birthday'     => $faker->date('Y-m-d'),
        'email'        => $faker->safeEmail,
        'social_media' => json_encode(['twitter'   => 'http://twitter.com/'.$faker->userName,
                                        'facebook' => 'http://facebook.com/'.$faker->userName,
        ]),
        'address'      => $faker->streetAddress,
        'city'         => $faker->city,
        'country'      => $faker->countryCode,
        'url'          => $faker->url,
        'password'     => bcrypt('password'),

    ];
});
