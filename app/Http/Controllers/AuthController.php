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

    public function register()
    {
        return view('auth.register');
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
        'kasir' => redirect()->route('kasir.dashboard')->with('message', 'Login berhasil'),
        'pemilik' => redirect()->route('pemilik.dashboard')->with('message', 'Login berhasil'),
        'dapur' => redirect()->route('dapur.dashboard')->with('message', 'Login berhasil'),
        default => redirect()->route('dashboard')->with('error', 'Role tidak dikenali'),
    };
}


    public function register_action(Request $request)
    {
        $valid = $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:150|unique:users,username',
            'password' => 'required|string|min:2|confirmed',
            'level' => 'required|in:admin,pelayan,kasir,dapur,pemilik', // Sesuai dengan level yang ada di database
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        try {
            $user = User::create([
                'nama' => $valid['nama'],
                'username' => $valid['username'],
                'password' => Hash::make($valid['password']),
                'level' => $valid['level'],
                'no_hp' => $valid['no_hp'],
                'alamat' => $valid['alamat'],
            ]);

            Auth::loginUsingId($user->id);

            // ✅ Log aktivitas registrasi berhasil
            Log::info('User Registered: ', ['username' => $valid['username'], 'ip' => $request->ip()]);

            return redirect(route('login'))->with('message', 'Register berhasil');
        } catch (\Throwable $th) {
            // 🚨 Log jika registrasi gagal
            Log::error('Gagal Registrasi: ', ['error' => $th->getMessage(), 'ip' => $request->ip()]);

            return back()->with('error', 'Terjadi kesalahan, coba lagi.');
        }
    }

    public function logout(Request $request)
    {
        $username = Auth::user()->username;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Log aktivitas logout
        Log::info('User Logout: ', ['username' => $username, 'ip' => $request->ip()]);

        return redirect('/login')->with('message', 'Logout berhasil');
    }
}
