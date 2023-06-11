<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.login'); 
    }

    public function auth(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(auth()->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])){
            return redirect('/');
        }else {
            return redirect()->route('login')->with(['error' => 'The credentials not right']);
        }
        
    }

    public function Register()
    {
        if(Auth::check()){
            return redirect('/');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:191',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        auth()->login($user);
        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
