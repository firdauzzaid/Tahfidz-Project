<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaGrupCabang extends Controller
{
  public function index()
  {
      // Ambil data dari tabel grup_cabang
      $grupCabang = DB::table('grup_cabang')
          ->select('id', 'nama_grup', 'alamat_grup', 'created_at')
          ->get();
  
      // Kirim data ke view
      return view('admin.kelola-grup-cabang', ['grupCabang' => $grupCabang]);
  }

  public function tambahGrupCabang(Request $request)
  {
      // Validasi input
      $request->validate([
          'nama_grup' => 'required|string|max:255',
          'alamat_grup' => 'required|string|max:500',
      ]);
  
      try {
          // Tambahkan data ke tabel grup_cabang
          DB::table('grup_cabang')->insert([
              'nama_grup' => $request->nama_grup,
              'alamat_grup' => $request->alamat_grup,
              'created_at' => now(),
              'updated_at' => now(),
          ]);
  
          return redirect()->back()->with('success', 'Grup cabang berhasil ditambahkan!');
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
  public function editGrupCabang(Request $request, $id)
  {
      // Validasi input
      $request->validate([
          'nama_grup' => 'required|string|max:255',
          'alamat_grup' => 'required|string|max:500',
      ]);
  
      try {
          // Update data di tabel grup_cabang berdasarkan ID
          $updated = DB::table('grup_cabang')
              ->where('id', $id)
              ->update([
                  'nama_grup' => $request->nama_grup,
                  'alamat_grup' => $request->alamat_grup,
                  'updated_at' => now(),
              ]);
  
          if ($updated) {
              return redirect()->back()->with('success', 'Grup cabang berhasil diperbarui!');
          } else {
              return redirect()->back()->with('error', 'Data grup cabang tidak ditemukan.');
          }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
  public function deleteGrupCabang($id)
  {
      try {
          // Hapus data di tabel grup_cabang berdasarkan ID
          $deleted = DB::table('grup_cabang')->where('id', $id)->delete();
  
          if ($deleted) {
              return redirect()->back()->with('success', 'Grup cabang berhasil dihapus!');
          } else {
              return redirect()->back()->with('error', 'Data grup cabang tidak ditemukan.');
          }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
}
