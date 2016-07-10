<?php

/**
 * Class PublicRoutesTest
 *
 * Test the response code for each publicly accessible route.
 */
class PublicRoutesTest extends TestCase
{

    use InteractsWithDatabase;

    /**
     * Test the response code for the Blog page.
     *
     * @return void
     */
    public function testBlogPageResponseCode()
    {

        factory(App\Models\User::class)->create();
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test the response code for the Login page.
     *
     * @return void
     */
    public function testLoginPageResponseCode()
    {
        $response = $this->call('GET', '/auth/login');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test the response code for the 404 Error Page.
     *
     * @return void
     */
    public function test404ErrorPageResponseCode()
    {
        $response = $this->call('GET', '/404ErrorPage');
        $this->assertEquals(404, $response->status());
    }
}
