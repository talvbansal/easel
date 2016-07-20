<?php

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 20/07/16
 * Time: 23:43
 */
class BlogPostTest extends TestCase
{

    use \Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

    /**
     * @var \Easel\Models\User
     */
    private $user;

    /**
     * Create the user model test subject.
     *
     * @before
     * @return void
     */
    public function createUser()
    {
        $this->user = factory(\Easel\Models\User::class)->create();
    }

    public function test_can_a_post_be_created()
    {
        $title        = 'test blog post';
        $slug         = 'test-blog-post';
        $subtitle     = 'test-sub-title';
        $content      = 'Here is test blog post data';
        $published_at = \Carbon\Carbon::now();
        $layout       = config('easel.layouts.default');

        $this->actingAs($this->user)->post('admin/post', [
            'title'        => $title,
            'slug'         => $slug,
            'subtitle'     => 'test-sub-title',
            'content'      => $content,
            'published_at' => $published_at->format('d/m/Y h:i:s'),
            'layout'       => $layout
        ]);

        $this->seeInDatabase('posts', [
            'title'        => $title,
            'slug'         => $slug,
            'subtitle'     => $subtitle,
            'content_raw'  => $content,
            'content_html' => '<p>' . $content . '</p>',
            'published_at' => $published_at->format('Y-m-d h:i:s'),
            'layout'       => $layout
        ]);

        $this->assertSessionHas('_new-post', trans('messages.create_success', ['entity' => 'post']));
        $this->assertRedirectedTo('admin/post');
    }

}