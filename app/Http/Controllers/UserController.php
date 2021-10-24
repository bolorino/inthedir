<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('backend.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $user->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => ($request->has('password_update') && ! empty($request->password_update) ? Hash::make($request->password_update) : $user->password)
        ]);

        return redirect()->route('user.index');
    }
}
