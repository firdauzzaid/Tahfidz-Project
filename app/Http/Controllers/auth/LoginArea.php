<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginArea extends Controller
{

  public function index()
  {
    return view('auth.login');
  }

  public function unauthorized()
  {
    return view('auth.unauthorized');
  }

public function cekLogin(Request $request)
{
    // Validasi input dengan pesan kesalahan dalam bahasa Indonesia
    $request->validate([
        'identifier' => 'required', // Pastikan input adalah email atau username
        'password' => 'required',
    ], [
        'identifier.required' => 'Email/Username wajib diisi.',
        'password.required' => 'Password wajib diisi.',
    ]);

    // Ambil input user
    $identifier = $request->input('identifier');

    // Tambahkan @gmail.com jika tidak ada
    if (!str_contains($identifier, '@')) {
        $identifier .= '@gmail.com';
    }

    // Ambil password
    $password = $request->input('password');
    // Ambil password dari nomor telepon
    $phone = $request->input('password');

    // Cek di tabel users
    $user = DB::table('users')
        ->where('email', $identifier)
        ->first();
        
    if (!$user) {
        return redirect()->back()->with('error', 'Email tidak ditemukan.');
    }
    
    // Cek apakah level user adalah Wali Santri
    if ($user->level == 2) {
        // Ambil data wali_santri berdasarkan id_wali
        $waliSantri = DB::table('data_walisantri')->where('id', $user->id_wali)->first();
    
        if ($waliSantri && $waliSantri->telepon === $phone) {
            // Login pengguna dan simpan sesi
            Auth::loginUsingId($user->id);
    
            // Redirect ke dashboard wali santri
            return redirect('/dashboard-walisantri');
        } else {
            return redirect()->back()->with('error', 'Nomor telepon salah.');
        }
    } else {
        if ($user && Hash::check($password, $user->password)) {
            // Login pengguna dan simpan sesi
            Auth::loginUsingId($user->id);
    
            // Redirect berdasarkan level user
            switch ($user->level) {
                case 0:
                    return redirect('/dashboard-admin');
                case 1:
                    return redirect('/dashboard-guru');
                default:
                    return redirect()->back()->with('error', 'Level user tidak valid.');
            }
        } else {
            // Jika tidak ditemukan atau password salah
            return redirect()->back()->with('error', 'Email atau Password salah.');
        }
    }
}

  public function logout(Request $request)
  {
    // Logout user
    Auth::logout();

    // Hapus sesi autentikasi
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect ke halaman login atau halaman lainnya
    return redirect()->route('auth-login')->with('success', 'Anda telah logout!');
  }
}
