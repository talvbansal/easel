<?php

namespace Easel\Http\Controllers\Auth;

use Easel\Http\Controllers\Controller;
use Easel\Models\BlogUserInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

/**
 * Class AuthController.
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * @var string
     */
    protected $redirectAfterLogout = '/login';

    /**
     * @var string
     */
    protected $redirectTo = '/admin/post';

    /**
     * @var string
     */
    protected $loginView = 'easel::auth.login';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getRegister()
    {
        return redirect('/');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister()
    {
        return redirect('/');
    }

    /**
     * @param Request           $request
     * @param BlogUserInterface $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticated(Request $request, BlogUserInterface $user)
    {
        \Session::set('_login', trans('easel::messages.login', ['first_name' => $user->first_name, 'last_name' => $user->last_name]));

        return redirect()->intended($this->redirectPath());
    }
}
