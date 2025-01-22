<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class RegisterController extends Controller
{
    public function index () {
        return view('auth.register');
    }

    public function store(Request $request) {
       @$request->request->add([ 'username' =>  Str::slug($request->username)]);
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|max:30|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);
        $email = $request->email;
        $password = $request->password;
        User::create([
            'name' => $request->name,
            'username' =>  $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        Auth::attempt(['email' => $email, 'password' => $password]);
        return redirect()->route('posts.index',Auth::user()->username);
    }
    //
}
