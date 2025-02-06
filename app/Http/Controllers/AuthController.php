<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view("auth.register");
    }

    public function showLogin()
    {
        return view("auth.login");
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed', //avtomatichno vijda passowrd_confirmation i go sravnqva s password
        ]);//avtomatichno hashira i usloqva

        $user = User::create($validated);

        Auth::login($user);
        return redirect()->route('tasks.index')->with('success', 'User registered!');
    }

    public function login()
    {

    }

}
