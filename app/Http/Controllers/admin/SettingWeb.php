<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingWeb extends Controller
{
  public function index()
  {
    // Ambil data dari tabel settings_web
    $settings = DB::table('settings_web')->first();

    // Kirim data ke view
    return view('admin.settings-website', ['settings' => $settings]);
  }

  public function updateWebsite(Request $request)
  {
    // Validasi input
    $validatedData = $request->validate([
      'nama_website' => 'required|string|max:255',
      'deskripsi_website' => 'required|string',
      'keyword_website' => 'required|string',
      'email_website' => 'required|email|max:255',
      'telpon_website' => 'required|string|max:255',
      'logo_website' => 'nullable|file|mimes:jpg,png,webp,svg,heic,jpeg|max:1024', // Max 1MB
    ]);

    try {
      // Ambil data pertama dari tabel
      $settings = DB::table('settings_web')->first();

      $logoPath = $settings->logo_website ?? null;

      // Jika ada file logo baru diunggah
      if ($request->hasFile('logo_website')) {
        $logo = $request->file('logo_website');

        // Format nama file dengan time() dan original name
        $logoNama = time() . '_' . $logo->getClientOriginalName();

        // Hapus logo lama jika ada
        if ($logoPath && Storage::exists('public/logo/' . $logoPath)) {
          Storage::delete('public/logo/' . $logoPath);
        }

        // Simpan file logo baru di folder public/logo
        $logo->storeAs('public/logo', $logoNama);

        // Set path logo baru
        $logoPath = 'logo/' . $logoNama;
      }

      // Data untuk disimpan/diupdate
      $data = [
        'nama_website' => $validatedData['nama_website'],
        'deskripsi_website' => $validatedData['deskripsi_website'],
        'keyword_website' => $validatedData['keyword_website'],
        'email_website' => $validatedData['email_website'],
        'telpon_website' => $validatedData['telpon_website'],
        'logo_website' => $logoPath,
        'status' => 1, // Default status: Aktif
      ];

      // Jika data sudah ada, lakukan update
      if ($settings) {
        DB::table('settings_web')->where('id', $settings->id)->update($data);
      } else {
        // Jika belum ada, lakukan insert
        DB::table('settings_web')->insert($data);
      }

      // Redirect dengan pesan sukses
      return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui.');
    } catch (\Exception $e) {
      // Redirect dengan pesan error
      return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }
}
