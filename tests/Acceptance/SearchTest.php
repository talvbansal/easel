<?php
use Easel\Models\Post;
use Easel\Models\Tag;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 18/08/16
 * Time: 15:15.
 */
class SearchTest extends TestCase
{
    use InteractsWithDatabase;

    /**
     * The user model.
     *
     * @var Easel\Models\User
     */
    private $user;


    /**
     * Create the user model test subject.
     *
     * @before
     *
     * @return void
     */
    public function createUser()
    {
        $this->user = factory(\Easel\Models\User::class)->create();
    }

    public function test_can_search_posts()
    {
        //create two posts to show up and one to not show
        $postA = factory(Post::class)->make([
            'title' => 'here is a test title that contains the word Easel',
            'slug' => 'test-slug',
            'content_raw' => 'no content'
        ]);
        $postB = factory(Post::class)->make([
            'content_raw' => 'here is a test content that contains the word Easel'
        ]);
        $postC = factory(Post::class)->make([
            'title'            => 'this shouldnt show up',
            'slug'             => 'this-shouldnt-show-up-slug',
            'subtitle'         => 'this-shouldnt-show-up',
            'meta_description' => 'this-shouldnt-show-up',
            'content_raw'      => 'this-shouldnt-show-up'
        ]);

        $postA->save();
        $postB->save();
        $postC->save();

        \Artisan::call('scout:import', ['model' => Post::class]);

        $posts    = Post::whereIn('id', [ 1, 2 ])->get();
        $response = $this->actingAs($this->user)->call('GET', '/admin/search?search=easel');

        $this->assertEquals(200, $response->status());
        $this->assertViewHas('posts', $posts);
    }

    public function test_can_search_tags()
    {
        //create two tag to show up and one to not show
        $tagA = factory(Tag::class)->make([ 'tag' => 'easel' ]);
        $tagB = factory(Tag::class)->make([ 'title' => 'easel']);
        $tagC = factory(Tag::class)->make([
            'tag'            => 'this shouldnt show up',
            'title'         => 'this-shouldnt-show-up',
            'meta_description' => 'this-shouldnt-show-up'
        ]);

        $tagA->save();
        $tagB->save();
        $tagC->save();

        \Artisan::call('scout:import', ['model' => Tag::class]);

        $tags     = Tag::whereIn('id', [ 1, 2 ])->get();
        $response = $this->actingAs($this->user)->call('GET', '/admin/search?search=easel');

        $this->assertEquals(200, $response->status());
        $this->assertViewHas('tags', $tags);
    }

}