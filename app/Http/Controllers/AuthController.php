<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Register Form
    public function showRegister()
    {
        return view("auth.registation");
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Registered Successfully!');
    }

    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login User
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid Credentials');
    }

    // Dashboard
    public function dashboard()
    {
        $productCount = Product::where('status','published')->count();
        return view('admin.dashboard.dashboard',compact('productCount'));
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
