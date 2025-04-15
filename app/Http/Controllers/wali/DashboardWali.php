<?php

namespace App\Http\Controllers\wali;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardWali extends Controller
{
  public function index()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Kirim data ke view
    return view('wali.dashboard-wali');
  }
  
    public function dataAbsensi()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::user()->id;
    
        // Cari username dari tabel users berdasarkan ID pengguna
        $user = DB::table('users')->where('id', $userId)->select('username')->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }
    
        // Cari id_santri dari tabel data_walisantri berdasarkan no_identitas = username
        $waliSantri = DB::table('data_walisantri')
            ->where('no_identitas', $user->username)
            ->select('id_santri')
            ->first();
        if (!$waliSantri) {
            return redirect()->back()->with('error', 'Data wali santri tidak ditemukan.');
        }
    
        // Cari data santri berdasarkan id_santri
        $santri = DB::table('data_santri')
            ->where('id', $waliSantri->id_santri)
            ->select('nama_lengkap as nama_santri')
            ->first();
        if (!$santri) {
            return redirect()->back()->with('error', 'Data santri tidak ditemukan.');
        }
    
        // Cari data absensi berdasarkan id_santri
        $absensi = DB::table('absen')
            ->where('id_santri', $waliSantri->id_santri)
            ->select(
                'id',
                'id_guru',
                'id_santri',
                'status',
                'tanggal_absensi',
                'created_at'
            )
            ->get();
    
        // Tambahkan nama guru ke data absensi
        foreach ($absensi as $absen) {
            $guru = DB::table('data_guru')
                ->where('id_users', $absen->id_guru)
                ->select('id_users')
                ->first();
    
            if ($guru) {
                $userGuru = DB::table('users')
                    ->where('id', $guru->id_users)
                    ->select('nama_lengkap')
                    ->first();
    
                $absen->nama_guru = $userGuru ? $userGuru->nama_lengkap : 'Tidak Diketahui';
            } else {
                $absen->nama_guru = 'Tidak Diketahui';
            }
        }
    
        // Gabungkan data untuk dikirim ke view
        $data = [
            'nama_santri' => $santri->nama_santri,
            'absensi' => $absensi
        ];
    
        // Kirim data ke view
        return view('wali.data-absensi', compact('data'));
    }

    public function dataNilai()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::user()->id;
    
        // Cari username dari tabel users berdasarkan ID pengguna
        $user = DB::table('users')->where('id', $userId)->select('username')->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }
    
        // Cari id_santri dari tabel data_walisantri berdasarkan no_identitas = username
        $waliSantri = DB::table('data_walisantri')
            ->where('no_identitas', $user->username)
            ->select('id_santri')
            ->first();
        if (!$waliSantri) {
            return redirect()->back()->with('error', 'Data wali santri tidak ditemukan.');
        }
    
        // Cari data santri berdasarkan id_santri
        $santri = DB::table('data_santri')
            ->where('id', $waliSantri->id_santri)
            ->select('nama_lengkap as nama_santri')
            ->first();
        if (!$santri) {
            return redirect()->back()->with('error', 'Data santri tidak ditemukan.');
        }
    
        // Data nilai tahsin
        $nilai_ptahsin = DB::table('nilai_ptahsin')
            ->where('id_santri', $waliSantri->id_santri)
            ->select('id', 'id_guru', 'id_santri', 'tanggal', 'jilid', 'halaman', 'keterangan', 'created_at')
            ->get();
    
        foreach ($nilai_ptahsin as $ptahsin) {
            $guru = DB::table('data_guru')->where('id_users', $ptahsin->id_guru)->select('id_users')->first();
            $userGuru = $guru ? DB::table('users')->where('id', $guru->id_users)->select('nama_lengkap')->first() : null;
            $ptahsin->nama_guru = $userGuru ? $userGuru->nama_lengkap : 'Tidak Diketahui';
        }
    
        // Data nilai tahfidz
        $nilai_ptahfidz = DB::table('nilai_ptahfidz')
            ->leftJoin('juz', 'nilai_ptahfidz.id_juz', '=', 'juz.id')
            ->leftJoin('juz_surat', 'nilai_ptahfidz.id_surah', '=', 'juz_surat.id')
            ->where('nilai_ptahfidz.id_santri', $waliSantri->id_santri)
            ->select(
                'nilai_ptahfidz.id', 'nilai_ptahfidz.id_guru', 'nilai_ptahfidz.id_santri', 'nilai_ptahfidz.tanggal',
                'nilai_ptahfidz.id_juz', 'nilai_ptahfidz.id_surah', 'nilai_ptahfidz.ayat', 'nilai_ptahfidz.keterangan',
                'nilai_ptahfidz.created_at', 'juz.nama_juz as nama_juz', 'juz_surat.nama_surat as nama_surat'
            )
            ->get();
    
        // Data nilai murojaah
        $nilai_murojaah = DB::table('nilai_murojaah')
            ->where('id_santri', $waliSantri->id_santri)
            ->select(
                'id', 'id_guru', 'id_santri', 'tanggal', 'waktu', 'juz', 'nama_surah', 'keterangan', 'created_at'
            )
            ->get();
    
        // Data nilai tasmi
        $nilai_tasmi = DB::table('nilai_tasmi')
            ->where('id_santri', $waliSantri->id_santri)
            ->select(
                'id', 'id_guru', 'id_santri', 'juz',
                'tajwid1', 'tajwid2', 'tajwid3', 'tajwid4',
                'fashohah1', 'fashohah2', 'fashohah3', 'fashohah4', 'created_at'
            )
            ->get();
    
        // Data nilai tahsin mutqin
        $nilai_mtahsin = DB::table('nilai_mtahsin')
            ->where('id_santri', $waliSantri->id_santri)
            ->select('id', 'id_guru', 'id_santri', 'jilid', 'level', 'nilai', 'created_at')
            ->get();
    
        // Data nilai tahfidz mutqin
        $nilai_mtahfidz = DB::table('nilai_mtahfidz')
            ->where('id_santri', $waliSantri->id_santri)
            ->select('id', 'id_guru', 'id_santri', 'tanggal', 'fashohah', 'pengetahuan', 'tajwid', 'created_at')
            ->get();
    
        // Tambahkan nama guru ke data nilai tambahan
        $allNilai = [$nilai_ptahfidz, $nilai_mtahsin, $nilai_mtahfidz, $nilai_murojaah, $nilai_tasmi];
        foreach ($allNilai as $nilaiCollection) {
            foreach ($nilaiCollection as $nilai) {
                $guru = DB::table('data_guru')->where('id_users', $nilai->id_guru)->select('id_users')->first();
                $userGuru = $guru ? DB::table('users')->where('id', $guru->id_users)->select('nama_lengkap')->first() : null;
                $nilai->nama_guru = $userGuru ? $userGuru->nama_lengkap : 'Tidak Diketahui';
            }
        }
    
        // Gabungkan data untuk dikirim ke view
        $data = [
            'nama_santri' => $santri->nama_santri,
            'nilai_ptahsin' => $nilai_ptahsin,
            'nilai_ptahfidz' => $nilai_ptahfidz,
            'nilai_mtahsin' => $nilai_mtahsin,
            'nilai_mtahfidz' => $nilai_mtahfidz,
            'nilai_murojaah' => $nilai_murojaah,
            'nilai_tasmi' => $nilai_tasmi,
        ];
    
        // Kirim data ke view
        return view('wali.data-nilai', compact('data'));
    }

}