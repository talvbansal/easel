<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 15/03/17
 * Time: 18:19.
 */

namespace EaselTest\Acceptance;


use EaselTest\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_()
    {
        $user = factory(\Easel\Models\User::class)->create();

        $this->actingAs( $user );

        $this->visit('/admin/category');

        $this->assertResponseStatus(200);
    }
}