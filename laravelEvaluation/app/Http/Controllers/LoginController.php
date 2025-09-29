<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('index'); // your login form
    }

    public function login(Request $request)
    {
        // validate inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'loginError' => 'Invalid email or password.'
            ])->withInput();
        }

        // Log the user in
        Auth::login($user);

        // Check if user already has a role assigned
        if ($user->role) {
            // Redirect directly to dashboard if role is already assigned
            return redirect('/dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
        } else {
            // Redirect to role selection if no role is assigned
            return redirect('/role-selection')->with('success', 'Welcome back, ' . $user->name . '!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/Login')->with('success', 'You have been logged out successfully.');
    }
}
