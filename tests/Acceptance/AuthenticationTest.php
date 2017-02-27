<?php
namespace EaselTest\Acceptance;

use Easel\Models\User;
use EaselTest\TestCase;

/**
 * Class AuthenticationTest.
 *
 * Test the login and logout functionality of the application.
 */
class AuthenticationTest extends TestCase
{
    /**
     * The user model.
     *
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
        $this->user = factory(User::class)->create();
    }

    /**
     * Test the ability for a user to log into the application.
     *
     * @return void
     */
    public function testApplicationLogin()
    {
        $this->visit('/login')
             ->type($this->user->email, 'email')
             ->type('password', 'password')
             ->press('submit')
             ->seeIsAuthenticatedAs($this->user)
             ->seePageIs('/admin/post');
    }

    /*
     * Test the ability for a user to log out of the application.
     *
     * @return void
     */
    public function testApplicationLogout()
    {
        /*
         * Laravel 5.3's logout route redirects to '/'
         * Easel does not provide a '/' route by default so for the purpose of testing
         * Create a test route so that the logout redirects properly
         */
        if (!\Route::has('/')) {
            \Route::get('/', '\Easel\Http\Controllers\Frontend\BlogController@index');
        }

        $this->actingAs($this->user)
             ->seeIsAuthenticatedAs($this->user)
             ->visit('/admin/post')
             ->click('Sign out')
             ->seePageIs('/')
             ->dontSeeIsAuthenticated();
    }
}
