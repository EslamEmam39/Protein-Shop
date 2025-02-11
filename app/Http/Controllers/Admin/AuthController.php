<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
  
        if (Auth::attempt($credentials)) {
            if (Auth::user()->hasRole('admin')) {
                $request->session()->regenerate(); 
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout(); // لو مش إدمن، نسجله خروج
                return back()->withErrors(['email' => 'ليس لديك صلاحية الدخول.']);
            }
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}