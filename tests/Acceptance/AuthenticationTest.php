<?php

/**
 * Class AuthenticationTest
 *
 * Test the login and logout functionality of the application.
 */
class AuthenticationTest extends TestCase
{

    use InteractsWithDatabase;

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
     * @return void
     */
    public function createUser()
    {

        $this->user = factory(Easel\Models\User::class)->create();

    }

    /**
     * Test the ability for a user to log into the application.
     *
     * @return void
     */
    public function testApplicationLogin()
    {

        $this->visit('/auth/login')
             ->type($this->user->email, 'email')
             ->type('password', 'password')
             ->press('submit')
             ->seeIsAuthenticatedAs($this->user)
             ->seePageIs('/admin/post');
    }

    /**
     * Test the ability for a user to log out of the application.
     *
     * @return void
     */
    public function testApplicationLogout()
    {

        $this->actingAs($this->user)
             ->visit('/admin/post')
             ->click('logout')
             ->seePageis('/auth/login')
             ->dontSeeIsAuthenticated();
    }

}