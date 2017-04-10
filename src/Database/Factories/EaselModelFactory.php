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
        'title'            => $title = $faker->sentence,
        'slug'             => str_replace(' ', '-', $title),
        'subtitle'         => $faker->sentence,
        'page_image'       => '/storage/placeholder.png',
        'content_raw'      => implode('\n', $faker->paragraphs(4)),
        'published_at'     => (Carbon\Carbon::now())->subWeek(),
        'meta_description' => $faker->sentence,
        'is_draft'         => false,
        'featured_post'    => false,
        'author_id'        => 1,
        'category_id'      => 1,
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
        'name'             => $faker->word,
        'slug'             => $faker->title,
    ];
});

/*
|--------------------------------------------------------------------------
| Category Model Factory
|--------------------------------------------------------------------------
|
| Create tags for the Welcome post in the database.
|
*/
$factory->define(Easel\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $name = $faker->word,
        'slug' => str_replace(' ', '_', $name),
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
        'email'        => $faker->safeEmail,
        'social_media' => json_encode([
            'twitter'  => 'http://twitter.com/'.$faker->userName,
            'facebook' => 'http://facebook.com/'.$faker->userName,
        ]),
        'city'     => $faker->city,
        'country'  => $faker->countryCode,
        'url'      => $faker->url,
        'password' => bcrypt('password'),
    ];
});
