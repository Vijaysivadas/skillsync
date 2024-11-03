<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManageController extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function register()
    {
        return view('auth.register');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
            'user_type' => 'required|in:user,recruiter', // check if its in company or recruiter
        ]);

        $credentials = $request->only('email', 'password', 'user_type');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            if (Auth::user()->user_type === 'user') {
                return redirect()->route('user.dashboard')->with('success', 'Welcome User!');
            } elseif (Auth::user()->user_type === 'recruiter') {
                return redirect()->route('recruiter.dashboard')->with('success', 'Welcome Recruiter!');
            }
        }

        return back()->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users,email',
            'password'      => 'required',
            'user_type'     => 'required|in:user,recruiter', // check if its in company or recruiter
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        Auth::login($user);

        if ($user->user_type === 'user') {
            return redirect()->route('user.dashboard')->with('success', 'Registration successful! Welcome Company!');
        } elseif ($user->user_type === 'recruiter') {
            return redirect()->route('recruiter.dashboard')->with('success', 'Registration successful! Welcome Recruiter!');
        }

        return redirect()->route('home')->with('success', 'Registration successful!');
    }
}
