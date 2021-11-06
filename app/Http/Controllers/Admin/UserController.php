<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    public function index()
    {
        $users = User::with('role')->get();

        return view('admin.users', ['users' => $users]);
    }

    public function userEdit(User $user)
    {
        return view('admin.user', ['user' => User::findOrFail($user->id), 'roles' => UserRole::get()]);
    }

    public function store(UserRequest $request)
    {
        $user = User::findOrFail($request->id);
        $user = $user->fill($request->validated())->save();

        if($user) {
            return redirect()
                ->route('admin.users')
                ->with('success', __('messages.admin.user.save.success'));
        }

        return back()->with('error', __('messages.admin.user.save.fail'));
    }
}
