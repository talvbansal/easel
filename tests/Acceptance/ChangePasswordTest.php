<?php

namespace EaselTest\Acceptance;

use EaselTest\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

/**
 * Created by PhpStorm.
 * User: talv
 * Date: 03/08/16
 * Time: 10:51.
 */
class ChangePasswordTest extends TestCase
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
     *
     * @return void
     */
    public function createUser()
    {
        $this->user = factory(\Easel\Models\User::class)->create(['password' => bcrypt('password')]);
    }

    public function test_a_user_can_update_their_password()
    {
        $this->actingAs($this->user)->put('/admin/profile/1/update-password', [
            'password'                  => 'password',
            'new_password'              => '123456',
            'new_password_confirmation' => '123456',
        ]);

        $this->assertSessionHas('_passwordUpdate', trans('easel::messages.update_success', ['entity' => 'Password']));

        $this->assertTrue(Auth::validate([
            'email'    => $this->user->email,
            'password' => '123456',
        ]));
    }

    public function test_current_password_must_match()
    {
        $this->actingAs($this->user)->put('/admin/profile/1/update-password', [
            'password'                  => 'not_my_password',
            'new_password'              => '123456',
            'new_password_confirmation' => '123456',
        ]);

        $this->assertSessionHas('errors');
    }

    public function test_new_and_confirm_passwords_must_match()
    {
        $this->actingAs($this->user)->put('/admin/profile/1/update-password', [
            'password'                  => 'password',
            'new_password'              => '654321',
            'new_password_confirmation' => '123456',
        ]);

        $this->assertSessionHas('errors');
    }
}
