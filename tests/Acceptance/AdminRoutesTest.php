<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class AdminRoutesTest
 *
 * Test the response code for each administrative route after login.
 */
class AdminRoutesTest extends TestCase
{
    use InteractsWithDatabase;

    /**
     * The user model.
     * 
     * @var App\Models\User
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

        $this->user = factory(App\Models\User::class)->create();

    }

    /**
     * Test the response code for the Posts page.
     *
     * @return void
     */
    public function testPostsPageResponseCode()
    {
        $response = $this->actingAs($this->user)->call('GET', '/admin/post');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test the response code for the Tags page.
     *
     * @return void
     */
    public function testTagsPageResponseCode()
    {
        $response = $this->actingAs($this->user)->call('GET', '/admin/tag');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test the response code for the Uploads page.
     *
     * @return void
     */
    public function testUploadsPageResponseCode()
    {

        $response = $this->actingAs($this->user)->call('GET', '/admin/upload');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test the response code for the Profile page.
     *
     * @return void
     */
    public function testProfilePageResponseCode()
    {
        $response = $this->actingAs($this->user)->call('GET', '/admin/profile');
        $this->assertEquals(200, $response->status());
    }
}
