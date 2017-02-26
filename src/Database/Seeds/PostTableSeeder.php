<?php
namespace Easel\Database\Seeds;

use Easel\Models\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Seed the posts table with the Welcome post.
     */
    public function run()
    {
        Post::truncate();

        factory(Post::class, 1)->create([
            'title'               => 'Hello world',
            'slug'                => 'hello-world',
            'subtitle'            => 'Easel is a blogging package for Laravel',
            'meta_description'    => 'Let\'s get you up and running with Easel!',
        ]);
    }
}
