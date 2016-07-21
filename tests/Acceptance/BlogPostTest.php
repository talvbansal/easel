<?php
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 20/07/16
 * Time: 23:43
 */
class BlogPostTest extends TestCase
{

    use InteractsWithDatabase;

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

    /**
     * @return array
     */
    private function getPostData()
    {
        $title        = 'test blog post';
        $slug         = 'test-blog-post';
        $subtitle     = 'test-sub-title';
        $content      = 'Here is test blog post data';
        $published_at = \Carbon\Carbon::now();
        $layout       = config('easel.layouts.default');

        return [ $title, $slug, $subtitle, $content, $published_at, $layout ];
    }

    /**
     * @param $title
     * @param $subtitle
     * @param $slug
     * @param $content
     * @param $published_at
     * @param $layout
     *
     * @return \Easel\Models\Post
     */
    private function createNewPost($title, $subtitle, $slug, $content, $published_at, $layout)
    {
        $post               = new \Easel\Models\Post();
        $post->title        = $title;
        $post->subtitle     = $subtitle;
        $post->slug         = $slug;
        $post->content_raw  = $content;
        $post->content_html = '<p>' . $content . '</p>';
        $post->published_at = $published_at->format('Y-m-d h:i:s');
        $post->layout       = $layout;
        $post->save();

        return $post;
    }

    public function test_a_post_can_be_created()
    {
        list( $title, $slug, $subtitle, $content, $published_at, $layout ) = $this->getPostData();

        // Create new post
        $this->actingAs($this->user)->post('admin/post', [
            'title'        => $title,
            'slug'         => $slug,
            'subtitle'     => $subtitle,
            'content'      => $content,
            'published_at' => $published_at->format('d/m/Y h:i:s'),
            'layout'       => $layout
        ]);

        // Is it there?
        $this->seeInDatabase('posts', [
            'title'        => $title,
            'slug'         => $slug,
            'subtitle'     => $subtitle,
            'content_raw'  => $content,
            'content_html' => '<p>' . $content . '</p>',
            'published_at' => $published_at->format('Y-m-d h:i:s'),
            'layout'       => $layout
        ]);

        $this->assertSessionHas('_new-post', trans('easel::messages.create_success', [ 'entity' => 'Post' ]));
        $this->assertRedirectedTo('admin/post');
    }

    public function test_a_post_can_be_edited()
    {
        // Create new post
        list( $title, $slug, $subtitle, $content, $published_at, $layout ) = $this->getPostData();
        $post = $this->createNewPost($title, $subtitle, $slug, $content, $published_at, $layout);

        // Edit the post
        $title   = 'Edited Post title';
        $content = 'We have new content!';

        $this->actingAs($this->user)->put('admin/post/' . $post->id, [
            'title'        => $title,
            'slug'         => $slug,
            'subtitle'     => $subtitle,
            'content'      => $content,
            'published_at' => $published_at->format('d/m/Y h:i:s'),
            'layout'       => $layout
        ]);

        // Can we see the changes?
        $this->seeInDatabase('posts', [
            'title'        => $title,
            'slug'         => $slug,
            'subtitle'     => $subtitle,
            'content_raw'  => $content,
            'content_html' => '<p>' . $content . '</p>',
            'published_at' => $published_at->format('Y-m-d h:i:s'),
            'layout'       => $layout
        ]);

        $this->assertSessionHas('_update-post', trans('easel::messages.update_success', [ 'entity' => 'Post' ]));
        $this->assertRedirectedTo('/admin/post/'. $post->id .'/edit');
    }

    public function test_a_post_can_be_deleted()
    {
        // Create new post
        list( $title, $slug, $subtitle, $content, $published_at, $layout ) = $this->getPostData();
        $post = $this->createNewPost($title, $subtitle, $slug, $content, $published_at, $layout);
        $this->assertTrue( \Easel\Models\Post::count() === 1);

        // Delete it!
        $this->actingAs($this->user)->delete('admin/post/' . $post->id );

        // Is It There?
        $this->assertTrue( \Easel\Models\Post::count() === 0);

        $this->assertSessionHas('_delete-post', trans('easel::messages.delete_success', [ 'entity' => 'Post' ]));
        $this->assertRedirectedTo('/admin/post');
    }


}