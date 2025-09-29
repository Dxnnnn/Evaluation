<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('role-selection', compact('user'));
    }

    public function selectRole(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'role' => 'required|in:admin,student'
        ]);

        // Check if user is trying to switch roles
        if ($user->role && $user->role !== $request->role) {
            // Prevent admin from selecting student role
            if ($user->role === 'admin' && $request->role === 'student') {
                return back()->withErrors([
                    'role' => 'Access denied: Administrators cannot switch to student role.'
                ])->withInput();
            }
            
            // Prevent student from selecting admin role (optional - you can remove this if students should be able to become admin)
            if ($user->role === 'student' && $request->role === 'admin') {
                return back()->withErrors([
                    'role' => 'Access denied: Students cannot switch to administrator role.'
                ])->withInput();
            }
        }

        // If user doesn't have a role yet, or if they're selecting their current role, allow it
        if (!$user->role || $user->role === $request->role) {
            $user->role = $request->role;
            $user->save();
            
            return redirect('/dashboard')->with('success', 'Welcome, ' . $user->name . '! You are logged in as ' . ucfirst($request->role));
        }

        // This shouldn't happen, but just in case
        return redirect('/dashboard')->with('success', 'Welcome back, ' . $user->name . '!');
    }
}

