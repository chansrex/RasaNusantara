<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return view('auth.login');
    }
    
    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Cek apakah user dengan email tersebut adalah admin
        $user = User::where('email', $request->email)->first();
        
        if ($user && $user->role !== 'admin') {
            return back()->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai admin.',
            ])->withInput();
        }
        
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }
        
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->withInput();
    }
    
    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Jika user adalah admin, redirect ke halaman login admin
        // Jika user adalah customer, redirect ke halaman registrasi customer
        return redirect()->route('self-order.index');
    }
} 