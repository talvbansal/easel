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
     * @return \Easel\Models\Post
     */
    private function createPostData()
    {
        return factory(\Easel\Models\Post::class)->make([ 'content_raw' => 'test content' ]);
    }

    /**
     * Not sure if this or the following test is better for some reason in this test we can't check whats in session.
     * However this hits the page with the form on too which is better than just the back end code being tested
     */
    public function test_a_user_can_create_a_post()
    {
        $post = $this->createPostData();

        $this->actingAs($this->user)->visit('admin/post/create')
             ->type($post->title, 'title')
             ->type($post->subtitle, 'subtitle')
             ->type($post->content_raw, 'content')
             ->type($post->published_at->format('d/m/Y h:i:s'), 'published_at')
             ->select($post->layout, 'layout')
             ->press('Save');

        // Is it there?
        $this->seeInDatabase('posts', [
            'title'        => $post->title,
            'slug'         => $post->slug,
            'subtitle'     => $post->subtitle,
            'content_raw'  => $post->content,
            'content_html' => '<p>' . $post->content . '</p>',
            'published_at' => $post->published_at->format('Y-m-d h:i:s'),
            'layout'       => $post->layout
        ]);

        $this->assertSessionHas('_new-post', trans('easel::messages.create_success', [ 'entity' => 'Post' ]));
        $this->seePageIs('admin/post');
    }

    public function test_a_post_can_be_created()
    {
        $post = $this->createPostData();

        // Create new post
        $this->actingAs($this->user)->post('admin/post', [
            'title'        => $post->title,
            'slug'         => $post->slug,
            'subtitle'     => $post->subtitle,
            'content'      => $post->content_raw,
            'published_at' => $post->published_at->format('d/m/Y h:i:s'),
            'layout'       => $post->layout
        ]);

        // Is it there?
        $this->seeInDatabase('posts', [
            'title'        => $post->title,
            'slug'         => $post->slug,
            'subtitle'     => $post->subtitle,
            'content_raw'  => $post->content,
            'content_html' => '<p>' . $post->content . '</p>',
            'published_at' => $post->published_at->format('Y-m-d h:i:s'),
            'layout'       => $post->layout
        ]);

        $this->assertSessionHas('_new-post', trans('easel::messages.create_success', [ 'entity' => 'Post' ]));
        $this->assertRedirectedTo('admin/post');
    }

    public function test_a_post_can_be_edited()
    {
        // Create new post
        $post = $this->createPostData();
        $post->save();

        // Edit the post
        $title   = 'Edited Post title';
        $content = 'We have new content!';

        // Save changes
        $this->actingAs($this->user)->put('admin/post/' . $post->id, [
            'title'        => $title,
            'slug'         => $post->slug,
            'subtitle'     => $post->subtitle,
            'content'      => $content,
            'published_at' => $post->published_at->format('d/m/Y h:i:s'),
            'layout'       => $post->layout
        ]);

        // Can we see the changes?
        $this->seeInDatabase('posts', [
            'title'        => $title,
            'slug'         => $post->slug,
            'subtitle'     => $post->subtitle,
            'content_raw'  => $content,
            'content_html' => '<p>' . $content . '</p>',
            'published_at' => $post->published_at->format('Y-m-d h:i:s'),
            'layout'       => $post->layout
        ]);

        $this->assertSessionHas('_update-post', trans('easel::messages.update_success', [ 'entity' => 'Post' ]));
        $this->assertRedirectedTo('/admin/post/' . $post->id . '/edit');
    }

    public function test_a_post_can_be_deleted()
    {
        // Create new post
        $post = $this->createPostData();
        $post->save();

        $this->assertTrue(\Easel\Models\Post::count() === 1);

        // Delete it!
        $this->actingAs($this->user)->delete('admin/post/' . $post->id);

        // Is It There?
        $this->assertTrue(\Easel\Models\Post::count() === 0);

        $this->assertSessionHas('_delete-post', trans('easel::messages.delete_success', [ 'entity' => 'Post' ]));
        $this->assertRedirectedTo('/admin/post');
    }


}