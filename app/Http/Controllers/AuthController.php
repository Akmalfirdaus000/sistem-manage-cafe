<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|min:2',
        ]);

        $user = User::where("username", $request->input('username'))->first();

        if (!$user) {
            return back()->withErrors(['username' => 'Username tidak ditemukan'])->onlyInput('username');
        }

        if (!in_array($user->level, ['admin', 'pelayan'])) {
            return back()->withErrors(['username' => 'Akun tidak diizinkan login.'])->onlyInput('username');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        Auth::login($user, $request->has('remember_me'));
        $request->session()->regenerate();

        Log::info('User Login:', ['username' => $user->username, 'level' => $user->level, 'ip' => $request->ip()]);

        // Redirect berdasarkan level
        return match ($user->level) {
            'admin' => redirect()->route('admin.dashboard')->with('message', 'Login berhasil'),
            'pelayan' => redirect()->route('pelayan.dashboard')->with('message', 'Login berhasil'),
            default => redirect()->route('dashboard')->with('error', 'Role tidak dikenali'),
        };
    }

    public function logout(Request $request)
    {
        $username = Auth::user()->username;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('User Logout: ', ['username' => $username, 'ip' => $request->ip()]);

        return redirect('/login')->with('message', 'Logout berhasil');
    }
}
