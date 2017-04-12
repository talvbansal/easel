<?php
namespace EaselTest\Unit\Model;

use Easel\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 12/04/17
 * Time: 14:48.
 */
class TagTest extends \EaselTest\TestCase
{
    use DatabaseMigrations;

    public function test_new_tags_are_generated()
    {
        factory(Tag::class)->create(['name' => 'Existing Tag']);

        $payload = [
            'Existing Tag',
            'London',
            'Travel',
        ];

        $response = Tag::addNeededTags( $payload );
        $this->assertEquals(2, $response);

        $this->seeInDatabase('tags', [
           'name' => 'London',
           'slug' => 'london',
        ]);

        $this->seeInDatabase('tags', [
           'name' => 'Travel',
           'slug' => 'travel',
        ]);
    }
}