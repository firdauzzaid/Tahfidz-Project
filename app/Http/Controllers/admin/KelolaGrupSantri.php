<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaGrupSantri extends Controller
{
  public function index()
  {
      // Ambil data dari tabel grup_santri
      $grupSantri = DB::table('grup_santri')
          ->select('id', 'id_cabang', 'nama_grup', 'jumlah_maksimal', 'created_at')
          ->get();

      $grupCabang = DB::table('grup_cabang')
          ->select('id', 'nama_grup', 'alamat_grup')
          ->get();
  
      // Kirim data ke view
    //   return view('admin.kelola-grup-santri', ['grupSantri' => $grupSantri], ['grupCabang' => $grupCabang]);
    return view('admin.kelola-grup-santri', compact('grupSantri', 'grupCabang'));
  }

  public function tambahGrupSantri(Request $request)
  {
      // Validasi input
      $request->validate([
          'grup_cabang' => 'required|exists:grup_cabang,id',
          'nama_grup' => 'required|string|max:255',
          'jumlah_maksimal' => 'required|numeric',
      ]);
  
      try {
        
        DB::table('grup_santri')->insert([
            'id_cabang' => $request->grup_cabang,
            'nama_grup' => $request->nama_grup,
            'jumlah_maksimal' => $request->jumlah_maksimal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
  
        return redirect()->back()->with('success', 'Grup santri berhasil ditambahkan!');
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
  public function editGrupSantri(Request $request, $id)
  {
      // Validasi input
      $request->validate([
          'grup_cabang' => 'required|exists:grup_cabang,id',
          'nama_grup' => 'required|string|max:255',
          'jumlah_maksimal' => 'required|numeric',
      ]);
  
      try {
          // Update data di tabel grup_santri berdasarkan ID
          $updated = DB::table('grup_santri')
              ->where('id', $id)
              ->update([
                  'id_cabang' => $request->grup_cabang,
                  'nama_grup' => $request->nama_grup,
                  'jumlah_maksimal' => $request->jumlah_maksimal,
                  'updated_at' => now(),
              ]);
  
          if ($updated) {
              return redirect()->back()->with('success', 'Grup santri berhasil diperbarui!');
          } else {
              return redirect()->back()->with('error', 'Data grup santri tidak ditemukan.');
          }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
  public function deleteGrupSantri($id)
  {
      try {
          // Hapus data di tabel grup_santri berdasarkan ID
          $deleted = DB::table('grup_santri')->where('id', $id)->delete();
  
          if ($deleted) {
              return redirect()->back()->with('success', 'Grup santri berhasil dihapus!');
          } else {
              return redirect()->back()->with('error', 'Data grup santri tidak ditemukan.');
          }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
}
