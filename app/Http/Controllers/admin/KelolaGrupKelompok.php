<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaGrupKelompok extends Controller
{
  public function index()
  {
      // Ambil data dari tabel grup_santri
      $grupSantri = DB::table('grup_santri')
          ->select('id', 'id_cabang', 'nama_grup')
          ->get();

      // Ambil data dari tabel kelompok_quran
      $grupKelompok = DB::table('kelompok_quran')
          ->select('id', 'id_rombel', 'nama_kelompok', 'jumlah', 'created_at')
          ->get();
  
      // Kirim data ke view
    //   return view('admin.kelola-grup-kelompok', ['grupKelompok' => $grupKelompok], ['grupSantri' => $grupSantri]);
    return view('admin.kelola-grup-kelompok', compact('grupSantri', 'grupKelompok'));
  }

  public function tambahGrupKelompok(Request $request)
  {
      // Validasi input
      $request->validate([
          'grup_santri' => 'required|exists:grup_santri,id',
          'nama_kelompok' => 'required|string|max:255',
          'jumlah' => 'required|numeric|min:1',
      ]);
  
      try {

        $jumlahKelompokQuran = DB::table('kelompok_quran')
            ->where('id_rombel', $request->grup_santri)
            ->sum('jumlah');

        // Ambil nilai jumlah_maksimal dari tabel grup_santri
        $maxKuota = DB::table('grup_santri')
            ->where('id', $request->grup_santri)
            ->value('jumlah_maksimal');

        // Validasi: Pastikan jumlah kelompok tidak melebihi jumlah maksimal grup santri
        if (($jumlahKelompokQuran + $request->jumlah) > $maxKuota) {
            return redirect()->back()->with('error', 'Jumlah kelompok tidak boleh melebihi jumlah maksimal rombel!');
        }

          // Tambahkan data ke tabel grup_cabang
        $tambah = DB::table('kelompok_quran')->insert([
              'id_rombel' => $request->grup_santri,
              'nama_kelompok' => $request->nama_kelompok,
              'jumlah' => $request->jumlah,
              'created_at' => now(),
              'updated_at' => now(),
          ]);
  
          if ($tambah) {
            return redirect()->back()->with('success', 'Grup kelompok berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Data grup kelompok tidak ditemukan.');
        }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
  public function editGrupKelompok(Request $request, $id)
  {
      // Validasi input
      $request->validate([
          'grup_santri' => 'required|exists:grup_santri,id',
          'nama_kelompok' => 'required|string|max:255',
          'jumlah' => 'required|numeric|min:1',
      ]);
  
      try {
        $jumlahKelompokQuran = DB::table('kelompok_quran')
            ->where('id_rombel', $request->grup_santri)
            ->sum('jumlah');

        // Ambil nilai jumlah_maksimal dari tabel grup_santri
        $maxKuota = DB::table('grup_santri')
            ->where('id', $request->grup_santri)
            ->value('jumlah_maksimal');

        // Validasi: Pastikan jumlah kelompok tidak melebihi jumlah maksimal grup santri
        if (($jumlahKelompokQuran + $request->jumlah) > $maxKuota) {
            return redirect()->back()->with('error', 'Jumlah kelompok tidak boleh melebihi jumlah maksimal rombel!');
        }

          // Update data di tabel grup_cabang berdasarkan ID
          $updated = DB::table('kelompok_quran')
              ->where('id', $id)
              ->update([
                  'id_rombel' => $request->grup_santri,
                  'nama_kelompok' => $request->nama_kelompok,
                  'jumlah' => $request->jumlah,
                  'updated_at' => now(),
              ]);
  
          if ($updated) {
              return redirect()->back()->with('success', 'Grup kelompok berhasil diperbarui!');
          } else {
              return redirect()->back()->with('error', 'Data grup kelompok tidak ditemukan.');
          }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
  public function deleteGrupKelompok($id)
  {
      try {
          // Hapus data di tabel grup_cabang berdasarkan ID
          $deleted = DB::table('kelompok_quran')->where('id', $id)->delete();
  
          if ($deleted) {
              return redirect()->back()->with('success', 'Grup kelompok berhasil dihapus!');
          } else {
              return redirect()->back()->with('error', 'Data grup kelompok tidak ditemukan.');
          }
      } catch (\Exception $e) {
          return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
      }
  }
  
}
