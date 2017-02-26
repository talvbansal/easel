<?php
namespace Easel\Database\Seeds;

use Illuminate\Database\Seeder;

class PostTagPivotTableSeeder extends Seeder
{
    /**
     * Seed the post tag pivot table with the Welcome post and tag.
     */
    public function run()
    {
        \DB::table('post_tag_pivot')->truncate();

        \DB::table('post_tag_pivot')->insert([
            'post_id' => 1,
            'tag_id'  => 1,
        ]);
    }
}
