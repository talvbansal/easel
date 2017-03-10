<?php

namespace EaselTest\Acceptance;

use EaselTest\TestCase;

/**
 * Class PublicRoutesTest.
 *
 * Test the response code for each publicly accessible route.
 */
class PublicRoutesTest extends TestCase
{
    /**
     * Test the response code for the Login page.
     *
     * @return void
     */
    public function testLoginPageResponseCode()
    {
        $response = $this->call('GET', '/login');
        $this->assertEquals(200, $response->status());
    }
}
