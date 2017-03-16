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
        $this->actingAs( $this->user )
            ->visit('/admin/category/create')
            ->type('Travel', 'name')
            ->type('travel', 'slug')
            ->press('Save');

        $this->seeInDatabase('categories', [
            'title' => 'Travel',
            'slug' => 'travel',
        ]);

        $this->seePageIs('admin/category');
    }

}
