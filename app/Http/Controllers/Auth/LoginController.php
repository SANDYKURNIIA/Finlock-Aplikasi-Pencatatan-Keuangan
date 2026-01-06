<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
public function create()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);
        unset($credentials['g-recaptcha-response']);
        $remember = $request->boolean('remember');

       if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard')
            ->with('success', 'Selamat Datang Kembali!');
    }
    return back()->withErrors([
        'email' => 'Email atau password yang Anda masukkan salah.',
    ])->onlyInput('email')
      ->with('error', 'Email atau password salah. Silakan coba lagi.');
        
    }
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}
