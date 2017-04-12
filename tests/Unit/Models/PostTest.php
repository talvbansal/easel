<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 12/04/17
 * Time: 15:48.
 */

namespace EaselTest\Unit\Model;


use Easel\Models\Post;
use Easel\Models\Tag;
use EaselTest\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function test_tags_are_synced()
    {
        $post = factory(Post::class)->create([
            'title' => 'tag test post',
        ]);

        $tags = ['new tag', 'tag again'];

        $post->syncTags($tags);

        $tag = Tag::find(1);
        $this->assertEquals('new tag', $tag->name );

        $this->seeInDatabase('post_tag_pivot', [
            'post_id' => $post->id,
            'tag_id' => $tag->id,
        ]);

        $tag = Tag::find(2);
        $this->assertEquals('tag again', $tag->name );

        $this->seeInDatabase('post_tag_pivot', [
            'post_id' => $post->id,
            'tag_id' => $tag->id,
        ]);
    }
}