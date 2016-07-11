<?php

use Easel\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TagTableSeeder extends Seeder
{
    /**
    * Seed the tags table with the Welcome tag.
    */
    public function run()
    {
        Tag::truncate();

        factory(Tag::class, 1)->create();
    }
}
