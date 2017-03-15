<?php

namespace Easel\Http\Controllers\Backend;

use Auth;
use Carbon\Carbon;
use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\PasswordUpdateRequest;
use Easel\Http\Requests\ProfileUpdateRequest;
use Easel\Models\BlogUserInterface;
use Session;

class ProfileController extends Controller
{
    /**
     * Display the user profile page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('easel::backend.profile.index', ['user' => Auth::user()]);
    }

    /**
     * Display the user profile edit page.
     *
     * @param BlogUserInterface $user
     *
     * @return \Illuminate\View\View
     */
    public function edit(BlogUserInterface $user)
    {
        return view('easel::backend.profile.edit', ['user' => $user]);
    }

    /**
     * Update the user profile information.
     *
     * @param ProfileUpdateRequest $request
     * @param BlogUserInterface    $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request, BlogUserInterface $user)
    {
        $data = $request->except(['_token', '_method', 'birthday']);
        foreach ($data as $key => $value) {
            $user->{$key} = (is_array($value)) ? json_encode($value) : $value;
        }

        $user->birthday = Carbon::createFromFormat('d/m/Y', $request->get('birthday'));

        $user->save();

        Session::put('_profile', trans('easel::messages.update_success', ['entity' => 'Profile']));

        return redirect()->route('admin.profile.edit', $user->id);
    }

    /**
     * Display the update password form.
     *
     * @param BlogUserInterface $user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword(BlogUserInterface $user)
    {
        return view('easel::backend.profile.password', ['user' => $user]);
    }

    /**
     * Update the users password.
     *
     * @param PasswordUpdateRequest $request
     * @param BlogUserInterface     $user
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function updatePassword(PasswordUpdateRequest $request, BlogUserInterface $user)
    {
        $this->validate($request, [
            'password'     => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $guard = \Auth::guard();
        if (!$guard->validate($request->only('password'))) {
            return back()->withErrors(trans('auth.failed'));
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        Session::put('_passwordUpdate', trans('easel::messages.update_success', ['entity' => 'Password']));

        return redirect()->route('admin.profile.edit.password', $user->id);
    }
}
