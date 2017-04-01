<?php

namespace EaselTest\Acceptance;

use Easel\Models\Tag;
use EaselTest\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 21/07/16
 * Time: 11:54.
 */
class TagsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var \Easel\Models\User
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

    /**
     * @return array
     */
    private function createTagData()
    {
        return factory(Tag::class)->make();
    }

    public function test_a_tag_can_be_created()
    {
        $tag = $this->createTagData();

        // Create new tag
        $this->actingAs($this->user)->post('admin/tag', [
            'name' => $tag->name,
            'slug' => $tag->slug,
        ]);

        // Is it there?
        $this->seeInDatabase('tags', [
            'name' => $tag->name,
            'slug' => $tag->slug,
        ]);

        $this->assertSessionHas('_new-tag', trans('easel::messages.create_success', ['entity' => 'Tag']));
        $this->assertRedirectedTo('admin/tag');
    }

    public function test_a_tag_can_be_edited()
    {
        // Create a new Tag
        $tag = factory(Tag::class)->make();
        $tag->save();

        // Edit the tag
        $title = 'Here is a new tag title that we edited!';

        // Save changes
        $this->actingAs($this->user)->put('admin/tag/'.$tag->id, [
            'name' => $title,
            'slug' => $tag->slug,
        ]);

        // Can we see the changes?
        $this->seeInDatabase('tags', [
            'name' => $title,
            'slug' => $tag->slug,
        ]);

        $this->assertSessionHas('_update-tag', trans('easel::messages.update_success', ['entity' => 'Tag']));
        $this->assertRedirectedTo('/admin/tag/'.$tag->id.'/edit');
    }

    public function test_a_tag_can_be_deleted()
    {
        // Create a new Tag
        $tag = factory(Tag::class)->create();

        // Delete it!
        $this->actingAs($this->user)->delete('admin/tag/'.$tag->id);

        // Is it there?
        $this->assertTrue(Tag::count() === 0);

        $this->assertSessionHas('_delete-tag', trans('easel::messages.delete_success', ['entity' => 'Tag']));
        $this->assertRedirectedTo('/admin/tag');
    }

    public function test_duplicate_tags_cannot_be_made()
    {
        $duplicateName = 'duplicate tag';
        $firstTag = factory(Tag::class)->create(['name' => $duplicateName]);
        $secondTag = factory(Tag::class)->make();

        // Create new tag
        $this->actingAs($this->user)->post('admin/tag', [
            'name' => $duplicateName,
            'slug' => $secondTag->slug,
        ]);

        $this->assertSessionHasErrors();
    }
}
