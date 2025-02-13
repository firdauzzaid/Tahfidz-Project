<?php

namespace App\Http\Controllers\landing;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Home extends Controller
{
    public function sertifikat($id_santri)
    {
        // Cek apakah id_santri valid
        $santri = DB::table('data_santri')->where('id', $id_santri)->first();
        if (!$santri) {
            return view('landing.sertifikat-tidak-valid');
        }
    
        // Ambil semua nama juz dari tabel juz
        $juzList = DB::table('juz')->pluck('nama_juz');
    
        // Ambil data nilai tasmi berdasarkan id_santri
        $nilaiTasmi = DB::table('nilai_tasmi')
                        ->where('id_santri', $id_santri)
                        ->select('juz', 'tajwid1', 'tajwid2', 'tajwid3', 'tajwid4', 'fashohah1', 'fashohah2', 'fashohah3', 'fashohah4', 'status')
                        ->get();
    
        // Cek apakah semua juz pada tabel juz ada di nilai tasmi dengan status = 1
        $lulus = true;
        foreach ($juzList as $namaJuz) {
            $juzTasmi = $nilaiTasmi->where('juz', $namaJuz)->first();
    
            // Jika juz tidak ada di nilai tasmi atau statusnya bukan 1
            if (!$juzTasmi || $juzTasmi->status != 1) {
                $lulus = false;
                break;
            }
        }
    
        if ($lulus) {
            // Ambil data lengkap santri
            $santriData = DB::table('data_santri')
                            ->where('id', $id_santri)
                            ->select('nama_lengkap', 'no_identitas')
                            ->first();
    
            // Ambil data wali santri dengan hubungan "Ayah"
            $waliSantri = DB::table('data_walisantri')
                            ->where('id_santri', $id_santri)
                            ->where('hubungan', 'Ayah')
                            ->select('nama_wali')
                            ->first();
    
            // Jika wali santri tidak ada, beri nilai "-"
            $namaWali = $waliSantri ? $waliSantri->nama_wali : "-";
    
            // Kirim data ke view landing.sertifikat
            return view('landing.sertifikat', [
                'santri' => $santriData,
                'wali' => $namaWali,
                'nilaiTasmi' => $nilaiTasmi,
            ]);
        } else {
            // Jika tidak lulus, arahkan ke view landing.belum-lulus
            return view('landing.belum-lulus');
        }
    }

}
