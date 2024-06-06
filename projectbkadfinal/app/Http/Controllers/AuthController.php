<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
    public function check(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard');
        }
        Alert::error('Gagal', 'Username atau password salah');
        return redirect()->route('auth.login');
    }
}
