<?php

namespace Easel\Database\Seeds;

use Easel\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the User model database seed.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        factory(Category::class)->create([
            'name' => 'Getting Started',
            'slug' => 'getting-started',
        ]);
    }
}
