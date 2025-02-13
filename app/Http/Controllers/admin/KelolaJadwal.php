<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KelolaJadwal extends Controller
{
  public function index()
  {
      // Ambil data guru dengan id_users, id_grup_cabang, dan id_grup_santri
      $dataGuru = DB::table('data_guru')
          ->select('id_users', 'id_grup_cabang', 'id_grup_santri')
          ->get();

      // Ambil data santri dengan nama_lengkap, id_grup_cabang, dan id_grup_santri
      $dataSantri = DB::table('data_santri')
          ->select('nama_lengkap', 'id_grup_cabang', 'id_grup_santri')
          ->get();

      // Gabungkan data guru dengan nama_lengkap dari tabel users
      $dataGuru = $dataGuru->map(function ($guru) {
          $user = DB::table('users')
              ->where('id', $guru->id_users)
              ->select('nama_lengkap')
              ->first();

          $guru->nama_lengkap = $user ? $user->nama_lengkap : null;

          // Ambil nama grup cabang berdasarkan id_grup_cabang
          $grupCabang = DB::table('grup_cabang')
              ->where('id', $guru->id_grup_cabang)
              ->select('nama_grup')
              ->first();

          $guru->nama_grup_cabang = $grupCabang ? $grupCabang->nama_grup : null;

          // Ambil nama grup santri berdasarkan id_grup_santri
          $grupSantri = DB::table('grup_santri')
              ->where('id', $guru->id_grup_santri)
              ->select('nama_grup')
              ->first();

          $guru->nama_grup_santri = $grupSantri ? $grupSantri->nama_grup : null;

          return $guru;
      });

      // Cocokkan data guru dan santri berdasarkan id_grup_cabang dan id_grup_santri
      $guruDanSantri = $dataGuru->map(function ($guru) use ($dataSantri) {
          $santri = $dataSantri->filter(function ($santri) use ($guru) {
              return $santri->id_grup_cabang == $guru->id_grup_cabang
                  && $santri->id_grup_santri == $guru->id_grup_santri;
          });

          // Jika ada santri yang cocok, tambahkan ke hasil
          return $santri->isNotEmpty() ? [
              'guru' => $guru,
              'santri' => $santri->values()
          ] : null;
      })->filter(); // Hapus data guru yang tidak memiliki santri yang cocok

      // Urutkan berdasarkan id_grup_santri dengan ID terkecil
      $guruDanSantri = $guruDanSantri->sortBy(function ($item) {
          return $item['guru']->id_grup_santri;
      });

      // Kirim data ke view
      return view('admin.kelola-jadwal', [
          'guruDanSantri' => $guruDanSantri
      ]);
  }

}
