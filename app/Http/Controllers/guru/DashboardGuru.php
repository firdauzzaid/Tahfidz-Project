<?php

namespace App\Http\Controllers\guru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardGuru extends Controller
{
  public function index()
  {
    // Hitung total santri
    $totalSantri = DB::table('data_santri')->count();

    // Hitung total guru
    $totalGuru = DB::table('data_guru')->count();

    // Hitung total santri lulus (status = 1)
    $totalSantriLulus = DB::table('data_santri')->where('status', 1)->count();

    // Hitung total santri belum lulus (status = 0)
    $totalSantriBelumLulus = DB::table('data_santri')->where('status', 0)->count();

    // Kirim data ke view
    return view('guru.dashboard-guru', compact('totalSantri', 'totalGuru', 'totalSantriLulus', 'totalSantriBelumLulus'));
  }

  public function myProfile(Request $request)
  {
    // Validasi data input
    $request->validate([
      'username' => 'required|string|max:255',
      'nama_lengkap' => 'required|string|max:255',
      'password' => 'nullable|string|min:6', // Password tidak wajib diisi
    ]);

    // Ambil ID pengguna yang sedang login
    $id = Auth::user()->id;

    // Ambil data input
    $username = $request->input('username');
    $namaLengkap = $request->input('nama_lengkap');
    $passwordInput = $request->input('password');

    try {
      // Cari password lama jika password baru tidak diisi
      $currentPassword = DB::table('users')->where('id', $id)->value('password');

      // Tentukan password yang akan disimpan
      $password = $passwordInput ? bcrypt($passwordInput) : $currentPassword;

      // Update data pengguna pada tabel users
      DB::table('users')->where('id', $id)->update([
        'username' => $username,
        'nama_lengkap' => $namaLengkap,
        'password' => $password,
        'updated_at' => now(),
      ]);

      return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }
}
