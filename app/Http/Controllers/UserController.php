<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CarPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showsignup()
    {
        return view('signup');
    }

    public function showlogin()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:22',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        // ELOQUENT ORM
        // INSERT INTO ......
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Sign Up Successfull.');

        // Password::min(8)->mixedCase()->numbers()->symbols()

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            flash()->success('Login Successful.');
            return redirect('/');
        }
        flash()->error('Invalid Credentials');

        // Auth::attempt()  ->User leko email pachadi database, password compare, login, session

        return back();

    }

    public function logout(Request $request)
    {
        Auth::logout(); // logout user
           flash()->success('Logout Successful.');

        // invalidate session
        $request->session()->invalidate();

        // regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('loginForm');
    }


    public function showProfile()
    {
        $user = Auth::user();
        $posts = CarPost::where('user_id', Auth::id())->get();

        return view('profile', compact('user', 'posts'));
    }
}
