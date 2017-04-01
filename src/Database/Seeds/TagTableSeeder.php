<?php

namespace Easel\Database\Seeds;

use Easel\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Seed the tags table with the Welcome tag.
     */
    public function run()
    {
        Tag::truncate();

        factory(Tag::class, 1)->create([
            'name' => 'Getting Started',
            'slug' => 'getting-started',
        ]);
    }
}
