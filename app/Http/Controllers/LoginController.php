<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        // validasi email dan password dulu
        $credential = $request->validate([
            'email' => 'required|email|',
            'password' => 'required'
        ]);

        // cek kelolosan email dan password
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            // jika berhasil, masuk ke dashboard
            return redirect()->intended('/dashboard');
        }

        // jika gagal
        return back()->with('loginError', 'Login failed!');
    }

    public function logout()
    {
        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
