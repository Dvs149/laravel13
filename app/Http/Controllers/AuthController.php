<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin()
    {       
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if ($this->authService->login($credentials)) {

            $request->session()->regenerate();

            if (auth()->user()->role == 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/dashboard');
        }

        return back()->with('error', 'Invalid Credentials');
    }

    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}