<?php

namespace EaselTest\Acceptance;

use Easel\Models\User;
use EaselTest\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class AdminRoutesTest.
 *
 * Test the response code for each administrative route after login.
 */
class AdminRoutesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * The user model.
     *
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
        $this->user = factory(User::class)->create();
    }

    /**
     * Test the response code for the Posts page.
     *
     * @return void
     */
    public function test_posts_page_response_code()
    {
        $this->actingAs($this->user)->visit('/admin/post')->assertResponseStatus(200);
    }

    /**
     * Test the response code for the Tags page.
     *
     * @return void
     */
    public function test_tags_page_response_code()
    {
        $this->actingAs($this->user)->visit('/admin/tag')->assertResponseStatus(200);
    }

    /**
     * Test the response code for the Category page.
     *
     * @return void
     */
    public function test_category_page_response_code()
    {
        $this->actingAs($this->user)->visit('/admin/category')->assertResponseStatus(200);
    }

    /**
     * Test the response code for the Uploads page.
     *
     * @return void
     */
    public function test_uploads_page_response_code()
    {
        $this->actingAs($this->user)->visit('/admin/media')->assertResponseStatus(200);
    }

    /**
     * Test the response code for the Profile page.
     *
     * @return void
     */
    public function test_profile_page_response_code()
    {
        $this->actingAs($this->user)->visit('/admin/profile')->assertResponseStatus(200);
    }
}
