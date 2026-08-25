<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => "required|min:3|max:50|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6|confirmed",
        ]);

        $user = User::create($data);
        Auth::login($user);

        return to_route('home');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return to_route('home');
        }

        return back()->withErrors([
            "email" => "email or password is not correct",
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
