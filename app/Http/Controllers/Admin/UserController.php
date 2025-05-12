<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::all();
        return view('admin.users.index', compact('users'));
    }
    public function block(\App\Models\User $user)
    {
        $user->status = 'blocked';
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User blocked successfully.');
    }

    public function unblock(\App\Models\User $user)
    {
        $user->status = 'active';
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User unblocked successfully.');
    }
}
