<?php

namespace App\Http\Controllers\guru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CetakData extends Controller
{
    public function cetakAbsensi(Request $request)
    {
        $userId = Auth::user()->id;

        // Ambil filter dari request
        $bulan = $request->input('bulan');
        $minggu = $request->input('minggu');
        $tahun = $request->input('tahun');
    
        // Ambil data absen dengan join ke tabel users dan data_santri
        $query = DB::table('absen')
            ->join('users', 'absen.id_guru', '=', 'users.id')
            ->join('data_santri', 'absen.id_santri', '=', 'data_santri.id')
            ->where('absen.id_guru', $userId)
            ->select(
                'absen.id',
                'absen.id_guru',
                'absen.id_santri',
                'absen.status',
                'absen.tanggal_absensi',
                'absen.created_at',
                'users.nama_lengkap as nama_guru',
                'data_santri.nama_lengkap as nama_santri'
        );

        // Jika ada filter, tambahkan filter tanggal
        if ($bulan && $minggu && $tahun) {
            // Tentukan awal bulan
            $startOfMonth = Carbon::create($tahun, $bulan, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            // Tentukan hari pertama dalam bulan ini
            $firstDayOfMonth = $startOfMonth->dayOfWeek;
            $firstMonday = $startOfMonth->copy()->next(Carbon::MONDAY);

            // Jika awal bulan sudah Senin, langsung pakai
            if ($firstDayOfMonth == Carbon::MONDAY) {
                $firstMonday = $startOfMonth;
            }

            // Hitung tanggal awal dan akhir untuk minggu yang dipilih
            $startOfWeek = $firstMonday->copy()->addWeeks($minggu - 1);
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            // Pastikan tidak melewati akhir bulan
            if ($endOfWeek->greaterThan($endOfMonth)) {
                $endOfWeek = $endOfMonth;
            }

            // Debug log
            Log::info("Filter Tanggal: Start = {$startOfWeek->format('Y-m-d')}, End = {$endOfWeek->format('Y-m-d')}");

            // Terapkan filter tanggal ke query
            $query->whereBetween('absen.tanggal_absensi', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')]);
        }

        // Ambil data dari query
        $data = $query->get();
    
        return view('cetak.absensi', compact('data'));
    }

    public function cetakPerkembanganTahsin(Request $request)
    {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Ambil filter dari request
    $bulan = $request->input('bulan');
    $minggu = $request->input('minggu');
    $tahun = $request->input('tahun');

    // Query data dengan filter tanggal
    $query = DB::table('nilai_ptahsin')
        ->join('users', 'nilai_ptahsin.id_guru', '=', 'users.id')
        ->join('data_santri', 'nilai_ptahsin.id_santri', '=', 'data_santri.id')
        ->where('nilai_ptahsin.id_guru', $userId)
        ->select(
            'nilai_ptahsin.id',
            'nilai_ptahsin.id_guru',
            'nilai_ptahsin.id_santri',
            'nilai_ptahsin.tanggal',
            'nilai_ptahsin.jilid',
            'nilai_ptahsin.halaman',
            'nilai_ptahsin.keterangan',
            'nilai_ptahsin.created_at',
            'users.nama_lengkap as nama_guru',
            'data_santri.nama_lengkap as nama_santri'
        );

        // Jika ada filter, tambahkan filter tanggal
        if ($bulan && $minggu && $tahun) {
            // Tentukan awal bulan
            $startOfMonth = Carbon::create($tahun, $bulan, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            // Tentukan hari pertama dalam bulan ini
            $firstDayOfMonth = $startOfMonth->dayOfWeek;
            $firstMonday = $startOfMonth->copy()->next(Carbon::MONDAY);

            // Jika awal bulan sudah Senin, langsung pakai
            if ($firstDayOfMonth == Carbon::MONDAY) {
                $firstMonday = $startOfMonth;
            }

            // Hitung tanggal awal dan akhir untuk minggu yang dipilih
            $startOfWeek = $firstMonday->copy()->addWeeks($minggu - 1);
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            // Pastikan tidak melewati akhir bulan
            if ($endOfWeek->greaterThan($endOfMonth)) {
                $endOfWeek = $endOfMonth;
            }

            // Debug log
            Log::info("Filter Tanggal: Start = {$startOfWeek->format('Y-m-d')}, End = {$endOfWeek->format('Y-m-d')}");

            // Terapkan filter tanggal ke query
            $query->whereBetween('nilai_ptahsin.tanggal', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')]);
        }

        // Ambil data dari query
        $data = $query->get();

    // Kirim data ke view
    return view('cetak.perkembangan-tahsin', compact('data', 'bulan', 'minggu', 'tahun'));
    }

    
    public function cetakPerkembanganTahfidz(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::user()->id;
    
        // Ambil filter dari request
        $bulan = $request->input('bulan');
        $minggu = $request->input('minggu');
        $tahun = $request->input('tahun');
    
        // Query data
        $query = DB::table('nilai_ptahfidz')
            ->join('users', 'nilai_ptahfidz.id_guru', '=', 'users.id')
            ->join('data_santri', 'nilai_ptahfidz.id_santri', '=', 'data_santri.id')
            ->join('juz', 'nilai_ptahfidz.id_juz', '=', 'juz.id')
            ->join('juz_surat', 'nilai_ptahfidz.id_surah', '=', 'juz_surat.id')
            ->where('nilai_ptahfidz.id_guru', $userId)
            ->select(
                'nilai_ptahfidz.id',
                'nilai_ptahfidz.id_guru',
                'nilai_ptahfidz.id_santri',
                'nilai_ptahfidz.tanggal',
                'nilai_ptahfidz.id_juz',
                'nilai_ptahfidz.id_surah',
                'nilai_ptahfidz.ayat',
                'nilai_ptahfidz.keterangan',
                'nilai_ptahfidz.created_at',
                'users.nama_lengkap as nama_guru',
                'data_santri.nama_lengkap as nama_santri',
                'juz.nama_juz as nama_juz',
                'juz_surat.nama_surat as nama_surat'
            );

        // Jika ada filter, tambahkan filter tanggal
        if ($bulan && $minggu && $tahun) {
            // Tentukan awal bulan
            $startOfMonth = Carbon::create($tahun, $bulan, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            // Tentukan hari pertama dalam bulan ini
            $firstDayOfMonth = $startOfMonth->dayOfWeek;
            $firstMonday = $startOfMonth->copy()->next(Carbon::MONDAY);

            // Jika awal bulan sudah Senin, langsung pakai
            if ($firstDayOfMonth == Carbon::MONDAY) {
                $firstMonday = $startOfMonth;
            }

            // Hitung tanggal awal dan akhir untuk minggu yang dipilih
            $startOfWeek = $firstMonday->copy()->addWeeks($minggu - 1);
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            // Pastikan tidak melewati akhir bulan
            if ($endOfWeek->greaterThan($endOfMonth)) {
                $endOfWeek = $endOfMonth;
            }

            // Debug log
            Log::info("Filter Tanggal: Start = {$startOfWeek->format('Y-m-d')}, End = {$endOfWeek->format('Y-m-d')}");

            // Terapkan filter tanggal ke query
            $query->whereBetween('nilai_ptahfidz.tanggal', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')]);
        }

        // Ambil data dari query
        $data = $query->get();
    
        // Kirim data ke view
        return view('cetak.perkembangan-tahfidz', compact('data', 'bulan', 'minggu', 'tahun'));
    }

    public function cetakMunaqasyahTahsin(Request $request)
    {
        $userId = Auth::user()->id;

        // Ambil filter dari request
        $bulan = $request->input('bulan');
        $minggu = $request->input('minggu');
        $tahun = $request->input('tahun');
    
        // Query data
        $query = DB::table('nilai_mtahsin')
            ->join('users', 'nilai_mtahsin.id_guru', '=', 'users.id')
            ->join('data_santri', 'nilai_mtahsin.id_santri', '=', 'data_santri.id')
            ->where('nilai_mtahsin.id_guru', $userId)
            ->select(
                'nilai_mtahsin.id',
                'nilai_mtahsin.id_guru',
                'nilai_mtahsin.id_santri',
                'nilai_mtahsin.jilid',
                'nilai_mtahsin.level',
                'nilai_mtahsin.nilai',
                'nilai_mtahsin.created_at',
                'users.nama_lengkap as nama_guru',
                'data_santri.nama_lengkap as nama_santri'
            );

        // Jika ada filter, tambahkan filter tanggal
        if ($bulan && $minggu && $tahun) {
            // Tentukan awal bulan
            $startOfMonth = Carbon::create($tahun, $bulan, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            // Tentukan hari pertama dalam bulan ini
            $firstDayOfMonth = $startOfMonth->dayOfWeek;
            $firstMonday = $startOfMonth->copy()->next(Carbon::MONDAY);

            // Jika awal bulan sudah Senin, langsung pakai
            if ($firstDayOfMonth == Carbon::MONDAY) {
                $firstMonday = $startOfMonth;
            }

            // Hitung tanggal awal dan akhir untuk minggu yang dipilih
            $startOfWeek = $firstMonday->copy()->addWeeks($minggu - 1);
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            // Pastikan tidak melewati akhir bulan
            if ($endOfWeek->greaterThan($endOfMonth)) {
                $endOfWeek = $endOfMonth;
            }

            // Debug log
            Log::info("Filter Tanggal: Start = {$startOfWeek->format('Y-m-d')}, End = {$endOfWeek->format('Y-m-d')}");

            // Terapkan filter tanggal ke query
            $query->whereBetween('nilai_mtahsin.created_at', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')]);
        }

        // Ambil data dari query
        $data = $query->get();
    
        return view('cetak.munaqasyah-tahsin', compact('data', 'bulan', 'minggu', 'tahun'));
    }
    public function cetakMunaqasyahTahfidz(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::user()->id;
    
        // Ambil filter dari request
        $bulan = $request->input('bulan');
        $minggu = $request->input('minggu');
        $tahun = $request->input('tahun');
    
        // Query data
        $query = DB::table('nilai_mtahfidz')
            ->join('users', 'nilai_mtahfidz.id_guru', '=', 'users.id')
            ->join('data_santri', 'nilai_mtahfidz.id_santri', '=', 'data_santri.id')
            ->join('juz', 'nilai_mtahfidz.juz', '=', 'juz.id')
            ->join('juz_surat', 'nilai_mtahfidz.id_juz_level', '=', 'juz_surat.id')
            ->where('nilai_mtahfidz.id_guru', $userId)
            ->select(
                'nilai_mtahfidz.id',
                'nilai_mtahfidz.id_guru',
                'nilai_mtahfidz.id_santri',
                'nilai_mtahfidz.tanggal',
                'nilai_mtahfidz.fashohah',
                'nilai_mtahfidz.pengetahuan',
                'nilai_mtahfidz.tajwid',
                'nilai_mtahfidz.created_at',
                'users.nama_lengkap as nama_guru',
                'data_santri.nama_lengkap as nama_santri',
                'juz.nama_juz as nama_juz',
                'juz_surat.nama_surat as nama_surat'
            );

        // Jika ada filter, tambahkan filter tanggal
        if ($bulan && $minggu && $tahun) {
            // Tentukan awal bulan
            $startOfMonth = Carbon::create($tahun, $bulan, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            // Tentukan hari pertama dalam bulan ini
            $firstDayOfMonth = $startOfMonth->dayOfWeek;
            $firstMonday = $startOfMonth->copy()->next(Carbon::MONDAY);

            // Jika awal bulan sudah Senin, langsung pakai
            if ($firstDayOfMonth == Carbon::MONDAY) {
                $firstMonday = $startOfMonth;
            }

            // Hitung tanggal awal dan akhir untuk minggu yang dipilih
            $startOfWeek = $firstMonday->copy()->addWeeks($minggu - 1);
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            // Pastikan tidak melewati akhir bulan
            if ($endOfWeek->greaterThan($endOfMonth)) {
                $endOfWeek = $endOfMonth;
            }

            // Debug log
            Log::info("Filter Tanggal: Start = {$startOfWeek->format('Y-m-d')}, End = {$endOfWeek->format('Y-m-d')}");

            // Terapkan filter tanggal ke query
            $query->whereBetween('nilai_mtahfidz.tanggal', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')]);
        }

        // Ambil data dari query
        $data = $query->get();
    
        // Kirim data ke view
        return view('cetak.munaqasyah-tahfidz', compact('data', 'bulan', 'minggu', 'tahun'));
    }
}