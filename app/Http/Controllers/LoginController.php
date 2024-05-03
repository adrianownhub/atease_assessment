<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Check the role of the authenticated user
            $user = Auth::user();
            if ($user->role === 'driver') {
                return redirect('/driver_index');
            } elseif ($user->role === 'admin') {
                return redirect('/index');
            }
        }

        return redirect()->back()->withInput()->withErrors(['username' => 'Invalid credentials']);
    }

    // Handle the logout request
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
