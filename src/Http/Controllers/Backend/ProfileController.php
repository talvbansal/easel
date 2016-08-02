<?php

namespace Easel\Http\Controllers\Backend;

use Auth;
use Carbon\Carbon;
use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\ProfileUpdateRequest;
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
        $user = Auth::user();
        $blog = config('easel.title');

        return view('easel::backend.profile.index', ['data' => $blog, 'user' => $user]);
    }

    /**
     * Display the user profile edit page.
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = Auth::user();
        $blog = config('easel.title');

        return view('easel::backend.profile.edit', ['data' => $blog, 'user' => $user]);
    }

    /**
     * Update the user profile information.
     *
     * @param ProfileUpdateRequest $request
     * @param                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $user = Auth::user();
        $data = $request->except(['_token', '_method', 'birthday']);
        foreach ($data as $key => $value) {
            $user->{$key} = (is_array($value)) ? json_encode($value) : $value;
        }

        $user->birthday = Carbon::createFromFormat('d/m/Y', $request->get('birthday'));

        $user->save();

        Session::set('_profile', trans('easel::messages.update_success', ['entity' => 'Profile']));

        return redirect()->route('admin.profile.edit', $id);
    }
}
