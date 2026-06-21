<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Check if user is admin
            if (Auth::user()->email === 'admin@example.com') {
                return redirect()->route('admin.dashboard');
            }
            
            Auth::logout();
            return back()->with('error', 'You are not authorized as admin.');
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}