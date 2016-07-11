<?php

use Easel\Models\Tag;
use Easel\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PostTableSeeder extends Seeder
{
    /**
    * Seed the posts table with the Welcome post. The
    * content of the Welcome post can be found
    * at view('site.admin.post.welcome').
    */
    public function run()
    {
        Post::truncate();

        factory(Post::class, 1)->create();
    }
}
