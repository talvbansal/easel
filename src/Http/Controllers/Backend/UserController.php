<?php
/**
 * Created by PhpStorm.
 * User: talv
 * Date: 06/04/17
 * Time: 16:06.
 */

namespace Easel\Http\Controllers\Backend;


use Easel\Http\Controllers\Controller;
use Easel\Http\Requests\UserCreateRequest;
use Easel\Http\Requests\UserUpdateRequest;
use Easel\Models\User;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = User::all();

        return view('easel::backend.user.index', compact('data'));
    }

    /**
     * Display the add a new user page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = new User();

        return view('easel::backend.user.create', compact('data'));
    }

    /**
     * Store a new user in the database.
     *
     * @param UserCreateRequest $request
     *
     * @return \Illuminate\View\View
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->fill($request->toArray())->save();
        $user->password = bcrypt($request->password);
        $user->save();

        Session::put('_new-user', trans('easel::messages.create_success', ['entity' => 'user']));

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the edit user page.
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('easel::backend.user.edit', compact('data'));
    }

    /**
     * Update the user information.
     *
     * @param UserUpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = User::findOrFail($id);
        $data->fill($request->toArray())->save();
        $data->password = bcrypt($request->password);
        $data->save();

        Session::put('_updateUser', trans('easel::messages.update_success', ['entity' => 'User ' . $data->display_name ]));

        return redirect()->route('admin.user.edit', compact('data'));
    }
}