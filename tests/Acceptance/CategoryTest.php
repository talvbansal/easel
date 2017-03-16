<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 15/03/17
 * Time: 18:19.
 */

namespace EaselTest\Acceptance;

use Easel\Models\Category;
use Easel\Models\User;
use EaselTest\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var User
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

    public function test_that_categories_can_be_listed()
    {
        factory(Category::class)->create([
           'name' => 'Inspiration',
           'slug' => 'inspiration',
        ]);

        factory(Category::class)->create([
           'name' => 'Travel',
           'slug' => 'travel',
        ]);

        $this->actingAs($this->user)
            ->visit('/admin/category')
            ->see('Inspiration')
            ->see('Travel');
    }

    public function test_a_user_can_create_a_category()
    {
        $this->actingAs($this->user)
            ->visit('/admin/category/create')
            ->type('Travel', 'name')
            ->type('travel', 'slug')
            ->press('Save');

        $this->seeInDatabase('categories', [
            'name' => 'Travel',
            'slug' => 'travel',
        ]);

        $this->seePageIs('admin/category');
    }

    public function test_a_user_cannot_create_a_category_that_already_exists()
    {
        factory(Category::class)->create([
            'name' => 'Travel',
            'slug' => 'travel',
        ]);

        $this->actingAs($this->user)
            ->visit('/admin/category/create')
            ->type('Travel', 'name')
            ->type('travel', 'slug')
            ->press('Save');

        $this->see('The name has already been taken.');
        $this->see('The slug has already been taken.');
    }

    public function test_a_category_can_be_edited()
    {
        $category = factory(Category::class)->create([
            'name' => 'Travel',
            'slug' => 'travel',
        ]);

        $this->actingAs($this->user)
             ->visit('/admin/category/'.$category->id.'/edit')
             ->type('Inspiration', 'name')
             ->type('inspiration', 'slug')
             ->press('Save');

        $this->seeInDatabase('categories', [
            'id'   => $category->id,
            'name' => 'Inspiration',
            'slug' => 'inspiration',
        ]);

        $this->seePageIs('/admin/category/'.$category->id.'/edit');
    }

    public function test_a_category_can_be_deleted()
    {
        // Create a new Category
        $category = factory(Category::class)->create();

        // Delete it!
        $this->actingAs($this->user)->delete('admin/category/'.$category->id);

        // Is it there?
        $this->assertTrue(Category::count() === 0);

        $this->assertSessionHas('_delete-category', trans('easel::messages.delete_success', ['entity' => 'Category']));
        $this->assertRedirectedTo('/admin/category');

    }
}
