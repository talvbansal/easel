<?php
namespace Easel\Http\Controllers\Auth;

use Easel\Models\BlogUserInterface;
use Session;
use Validator;
use JsValidator;
use Easel\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
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
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectAfterLogout = '/auth/login';

    protected $redirectTo = '/admin/post';
    
    protected $loginView = 'vendor.easel.auth.login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    public function getRegister()
    {
        return redirect('/');
    }

    public function postRegister()
    {
        return redirect('/');
    }

    public function authenticated(\Illuminate\Http\Request $request, BlogUserInterface $user)
    {
        \Session::set('_login', trans('easel::messages.login', ['first_name' => $user->first_name, 'last_name' => $user->last_name]));
        return redirect()->intended($this->redirectPath());
    }
}
