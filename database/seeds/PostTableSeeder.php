<?php

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

        factory(Post::class, 1)->create();
    }
}
