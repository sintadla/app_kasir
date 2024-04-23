<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'alpha_dash'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            LogActivity::add('Berhasil Login');
        }

        return back()
            ->withErrors(['username' => 'Username atau password yang dimasukkan tidak cocok dengan data kami.'])
            ->withInput($request->only('username'));
    }

    public function logout(Request $request)
    
    {
        LogActivity::add('Berhasil Logout');
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function store(Request $request)
    {
        return to_route('transaksi.show',['transaksi'=>$transaksi->id]);
    }
}
