<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

return redirect('/dashboard')->with('success',$user->name);

    }
}
