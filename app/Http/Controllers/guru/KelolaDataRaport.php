<?php

namespace App\Http\Controllers\guru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaDataRaport extends Controller
{
  public function index()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Kirim data ke view
    return view('guru.kelola-data-raport');
  }
  
  // Simpan data ke tabel nilai_mtahsin
  public function simpanMTahsin(Request $request)
  {
        $guruId = Auth::user()->id;
    
        // Validasi input
        $request->validate([
            'id_santri' => 'required',
            'jilid' => 'required',
            'level' => 'required',
            'nilai' => 'required|integer',
        ]);
    
    
        // Simpan data baru
        DB::table('nilai_mtahsin')->insert([
            'id_guru' => $guruId,
            'id_santri' => $request->id_santri,
            'jilid' => $request->jilid,
            'level' => $request->level,
            'nilai' => $request->nilai,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Nilai Munaqasyah Tahsin Berhasil Disimpan');
  }

  // Simpan data ke tabel nilai_ptahsin
  public function simpanPTahsin(Request $request)
  {
    $guruId = Auth::user()->id;
    
    // Validasi input
    $request->validate([
        'grup_cabang' => 'required',
        'grup_santri' => 'required',
        'grup_kelompok' => 'required',
        'id_santri' => 'required',
        'tanggal' => 'required|date',
        'jilid' => 'required',
        'halaman' => 'required|integer',
        'keterangan' => 'nullable|string',
    ]);
    
    // Cek apakah data dengan id_santri sudah ada di tabel
    $exists = DB::table('nilai_ptahsin')
                ->where('id_santri', $request->id_santri)
                ->where('tanggal', $request->tanggal)
                ->exists();
    
    if ($exists) {
        return redirect()->back()->with('error', 'Santri Tersebut Sudah Memiliki Nilai Pada Tanggal yang Sama.');
    }

    // Ambil data santri untuk dropdown berdasarkan kelompok yang dipilih
    $santriData = DB::table('data_santri')
        ->select('id', 'nama_lengkap')
        ->where('id_grup_kelompok', $request->grup_kelompok)
        ->get()
        ->toArray();

    /// Ambil data kelas, rombel, kelompok, juz dan level berdasarkan ID
    $cabangKelas = DB::table('grup_cabang')
        ->where('id', $request->grup_cabang)
        ->first(['id', 'nama_grup']);

    $cabangRombel = DB::table('grup_santri')
        ->where('id', $request->grup_santri)
        ->first(['id', 'id_cabang', 'nama_grup']);

    $cabangKelompok = DB::table('kelompok_quran')
        ->where('id', $request->grup_kelompok)
        ->first(['id', 'id_rombel', 'nama_kelompok']);

    // Simpan data baru
    $nilaiId = DB::table('nilai_ptahsin')->insertGetId([
      'id_guru' => $guruId,
      'id_santri' => $request->id_santri,
      'tanggal' => $request->tanggal,
      'jilid' => $request->jilid,
      'halaman' => $request->halaman,
      'keterangan' => $request->keterangan,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // Menyimpan informasi dalam session untuk digunakan nanti
    session([
      'nilaiId' => $nilaiId,
      'id_guru' => $guruId,
      'idGrupCabang' => $request->grup_cabang,
      'idGrupSantri' => $request->grup_santri,
      'idGrupKelompok' => $request->grup_kelompok,
      'santriData' => $santriData,
    ]);

    // Jika salah satu data tidak ditemukan, tampilkan pesan error
    if (!$cabangKelas || !$cabangRombel || !$cabangKelompok) {
      return redirect()->back()->with('error', 'Data Tidak Ditemukan. Silakan periksa kembali.');
    }

    // Simpan nama kelas, rombel, dan kelompok ke session
    session([
      'namaGrupCabang' => $cabangKelas,
      'namaGrupSantri' => $cabangRombel,
      'namaGrupKelompok' => $cabangKelompok,
    ]);

    // Update selected_surah di session
    $selectedSantri = session('selected_santri', []);
    $selectedSantri[] = $request->id_santri;
    session(['selected_santri' => $selectedSantri]);
    
    return redirect()->back()->with('success', 'Nilai Perkembangan Tahsin Berhasil Disimpan');
  }

  // Simpan data nilai lanjutan ke tabel p_tahsin
  public function simpanDataLanjutanPTahsin(Request $request)
  { 
    // Validasi input
    $request->validate([
      'id_santri' => 'required',
      'tanggal' => 'required|date',
      'jilid' => 'required',
      'halaman' => 'required|integer',
      'keterangan' => 'nullable|string',
    ]);

    $guruId = session('id_guru');
    $grupCabang = session('idGrupCabang');
    $grupSantri = session('idGrupSantri');
    $grupKelompok = session('idGrupKelompok');
    
    // Cek apakah data dengan id_santri sudah ada di tabel
    $exists = DB::table('nilai_ptahsin')
      ->where('id_santri', $request->id_santri)
      ->where('tanggal', $request->tanggal)
      ->exists();
    
      if ($exists) {
        return redirect()->back()->with('error', 'Santri Tersebut Sudah Memiliki Nilai Pada Tanggal yang Sama.');
    }

    /// Ambil data kelas, rombel, dan kelompok berdasarkan ID
    $cabangKelas = DB::table('grup_cabang')
        ->where('id', $grupCabang)
        ->first(['id', 'nama_grup']);

    $cabangRombel = DB::table('grup_santri')
        ->where('id', $grupSantri)
        ->first(['id', 'id_cabang', 'nama_grup']);

    $cabangKelompok = DB::table('kelompok_quran')
        ->where('id', $grupKelompok)
        ->first(['id', 'id_rombel', 'nama_kelompok']);

    // Jika salah satu data tidak ditemukan, tampilkan pesan error
    if (!$cabangKelas || !$cabangRombel || !$cabangKelompok) {
      return redirect()->back()->with('error', 'Data Tidak Ditemukan. Silakan periksa kembali.');
    }

    // Simpan nama kelas, rombel, dan kelompok ke session
    session([
      'namaGrupCabang' => $cabangKelas,
      'namaGrupSantri' => $cabangRombel,
      'namaGrupKelompok' => $cabangKelompok,
    ]);

    // Simpan data baru
    DB::table('nilai_ptahsin')->insert([
      'id_guru' => $guruId,
      'id_santri' => $request->id_santri,
      'tanggal' => $request->tanggal,
      'jilid' => $request->jilid,
      'halaman' => $request->halaman,
      'keterangan' => $request->keterangan,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // Update selected_surah di session
    $selectedSantri = session('selected_santri', []);
    $selectedSantri[] = $request->id_santri;
    session(['selected_santri' => $selectedSantri]);

    return redirect()->back()->with('success', 'Penilaian berhasil disimpan, lanjutkan penilaian!');
  }

  // Reset data untuk menambahkan data baru p_tahsin
  public function tambahDataAwalPTahsin()
  {
      // Hapus data session jika ada dan arahkan ke halaman input awal
      session()->forget('nilaiId', 'idGrupCabang', 'idGrupSantri', 'idGrupKelompok');
      return redirect()->route('guru.perkembanganTahsin');
  }

  public function editPTahsin(Request $request, $id)
  {
    // Validasi input
    $request->validate([
      'jilid' => 'required|string|max:255',
      'halaman' => 'required|string|max:255',
      'keterangan' => 'nullable|string|max:500',
    ]);

    // Cari data berdasarkan ID
    $data = DB::table('nilai_ptahsin')->where('id', $id)->first();

    if (!$data) {
      return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // Update data
    DB::table('nilai_ptahsin')->where('id', $id)->update([
      'jilid' => $request->jilid,
      'halaman' => $request->halaman,
      'keterangan' => $request->keterangan,
      'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Data berhasil diperbarui.');
  }

  public function hapusPTahsin($id)
  {
    // Cari data berdasarkan ID
    $data = DB::table('nilai_ptahsin')->where('id', $id)->first();

    if (!$data) {
      return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // Hapus data
    DB::table('nilai_ptahsin')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus.');
  }

  // Simpan data ke tabel nilai_ptahfidz
  public function simpanPTahfidz(Request $request)
  {
    $guruId = Auth::user()->id;
    
    // Validasi input
    $request->validate([
      'grup_cabang' => 'required',
      'grup_santri' => 'required',
      'grup_kelompok' => 'required',
      'id_santri' => 'required',
      'tanggal' => 'required|date',
      'id_juz' => 'required',
      'level' => 'required',
      'id_surah' => 'required',
      'ayat' => 'required|string',
      'keterangan' => 'nullable|string',
    ]);
    
    // Cek apakah santri sudah memiliki nilai pada tanggal atau surah yang sama
    $existingRecord = DB::table('nilai_ptahfidz')
        ->where('id_santri', $request->id_santri)
        ->where(function ($query) use ($request) {
            $query->where('tanggal', $request->tanggal)
                  ->orWhere('id_surah', $request->id_surah);
        })
        ->first();

      if ($existingRecord) {
        $errorMessage = $existingRecord->tanggal == $request->tanggal 
            ? 'Santri sudah memiliki nilai pada tanggal yang sama.'
            : 'Santri sudah memiliki nilai pada surah yang sama.';

        return redirect()->back()->with('error', $errorMessage);
    }

    // Ambil data santri untuk dropdown berdasarkan kelompok yang dipilih
    $santriData = DB::table('data_santri')
      ->select('id', 'nama_lengkap')
      ->where('id_grup_kelompok', $request->grup_kelompok)
      ->get()
      ->toArray();

      // Ambil data surah untuk dropdown berdasarkan level yang dipilih
    $surahData = DB::table('juz_surat')
      ->select('id', 'nama_surat')
      ->where('id_juz_level', $request->level)
      ->get()
      ->toArray();

    /// Ambil data kelas, rombel, kelompok, juz dan level berdasarkan ID
    $cabangKelas = DB::table('grup_cabang')
        ->where('id', $request->grup_cabang)
        ->first(['id', 'nama_grup']);

    $cabangRombel = DB::table('grup_santri')
        ->where('id', $request->grup_santri)
        ->first(['id', 'id_cabang', 'nama_grup']);

    $cabangKelompok = DB::table('kelompok_quran')
        ->where('id', $request->grup_kelompok)
        ->first(['id', 'id_rombel', 'nama_kelompok']);

    $grupJuz = DB::table('juz')
        ->where('id', $request->id_juz)
        ->first(['id', 'nama_juz']);

    $grupLevel = DB::table('juz_level')
        ->where('id', $request->level)
        ->first(['id', 'id_juz', 'level']);
    
    // Simpan data baru
    $nilaiId = DB::table('nilai_ptahfidz')->insertGetId([
      'id_guru' => $guruId,
      'id_santri' => $request->id_santri,
      'tanggal' => $request->tanggal,
      'id_juz' => $request->id_juz,
      'id_surah' => $request->id_surah,
      'ayat' => $request->ayat,
      'keterangan' => $request->keterangan,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // Menyimpan informasi dalam session untuk digunakan nanti
    session([
      'nilaiId' => $nilaiId,
      'id_guru' => $guruId,
      'id_santri' => $request->id_santri,
      'idGrupCabang' => $request->grup_cabang,
      'idGrupSantri' => $request->grup_santri,
      'idGrupKelompok' => $request->grup_kelompok,
      'tanggal' => $request->tanggal,
      'juz' => $request->id_juz,
      'id_juz' => $request->level,
      'santriData' => $santriData,
      'surahData' => $surahData,
    ]);

    // Jika salah satu data tidak ditemukan, tampilkan pesan error
    if (!$cabangKelas || !$cabangRombel || !$cabangKelompok || !$grupJuz || !$grupLevel) {
      return redirect()->back()->with('error', 'Data Tidak Ditemukan. Silakan periksa kembali.');
    }

    // Simpan nama kelas, rombel, dan kelompok ke session
    session([
      'namaGrupCabang' => $cabangKelas,
      'namaGrupSantri' => $cabangRombel,
      'namaGrupKelompok' => $cabangKelompok,
      'namaJuz' => $grupJuz,
      'namaLevel' => $grupLevel,
    ]);

    // Update selected_santri di session
    $selectedSantri = session('selected_santri', []);
    $selectedSantri[] = $request->id_santri;
    session(['selected_santri' => $selectedSantri]);

    // Update selected_surah di session
    $selectedSurah = session('selected_surah', []);
    $selectedSurah[] = $request->id_surah;
    session(['selected_surah' => $selectedSurah]);
    
    return redirect()->back()->with('success', 'Nilai Perkembangan Tahfidz Berhasil Disimpan');
  }

  // Simpan data nilai lanjutan ke tabel p_tahsin
  public function simpanDataLanjutanPTahfidz(Request $request)
  { 
    // Validasi input
    $request->validate([
      'id_santri' => 'required',
      'id_surah' => 'required',
      'ayat' => 'required|string',
      'keterangan' => 'nullable|string',
   ]);

    $guruId = session('id_guru');
    $idSantri = session('id_santri');
    $grupCabang = session('idGrupCabang');
    $grupSantri = session('idGrupSantri');
    $grupKelompok = session('idGrupKelompok');
    $tanggal = session('tanggal');
    $idJuz = session('juz');
    $idLevel = session('id_juz');
    
    // Cek apakah santri sudah memiliki nilai pada tanggal atau surah yang sama
    $existingRecord = DB::table('nilai_ptahfidz')
        ->where('id_santri', $idSantri)
        ->where(function ($query) use ($request) {
            $query->where('tanggal', $request->tanggal)
                  ->orWhere('id_surah', $request->id_surah);
        })
        ->first();

      if ($existingRecord) {
        $errorMessage = $existingRecord->tanggal == $request->tanggal 
            ? 'Santri sudah memiliki nilai pada tanggal yang sama.'
            : 'Santri sudah memiliki nilai pada surah yang sama.';

        return redirect()->back()->with('error', $errorMessage);
    }

    /// Ambil data kelas, rombel, kelompok, juz dan level berdasarkan ID
    $cabangKelas = DB::table('grup_cabang')
        ->where('id', $grupCabang)
        ->first(['id', 'nama_grup']);

    $cabangRombel = DB::table('grup_santri')
        ->where('id', $grupSantri)
        ->first(['id', 'id_cabang', 'nama_grup']);

    $cabangKelompok = DB::table('kelompok_quran')
        ->where('id', $grupKelompok)
        ->first(['id', 'id_rombel', 'nama_kelompok']);

    $grupJuz = DB::table('juz')
        ->where('id', $idJuz)
        ->first(['id', 'nama_juz']);

    $grupLevel = DB::table('juz_level')
        ->where('id', $idLevel)
        ->first(['id', 'id_juz', 'level']);

    // Jika salah satu data tidak ditemukan, tampilkan pesan error
    if (!$cabangKelas || !$cabangRombel || !$cabangKelompok || !$grupJuz || !$grupLevel) {
      return redirect()->back()->with('error', 'Data Tidak Ditemukan. Silakan periksa kembali.');
    }

    // Simpan nama kelas, rombel, dan kelompok ke session
    session([
      'namaGrupCabang' => $cabangKelas,
      'namaGrupSantri' => $cabangRombel,
      'namaGrupKelompok' => $cabangKelompok,
      'namaJuz' => $grupJuz,
      'namaLevel' => $grupLevel,
    ]);

    // Simpan data baru
    DB::table('nilai_ptahfidz')->insert([
      'id_guru' => $guruId,
      'id_santri' => $request->id_santri,
      'tanggal' => $tanggal,
      'id_juz' => $idJuz,
      'id_surah' => $request->id_surah,
      'ayat' => $request->ayat,
      'keterangan' => $request->keterangan,
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // Update selected_santri di session
    $selectedSantri = session('selected_santri', []);
    $selectedSantri[] = $request->id_santri;
    session(['selected_santri' => $selectedSantri]);

    // Update selected_surah di session
    $selectedSurah = session('selected_surah', []);
    $selectedSurah[] = $request->id_surah;
    session(['selected_surah' => $selectedSurah]);

    return redirect()->back()->with('success', 'Penilaian berhasil disimpan, lanjutkan penilaian!');
  }

  // Reset data untuk menambahkan data baru p_tahsin
  public function tambahDataAwalPTahfidz()
  {
      // Hapus data session jika ada dan arahkan ke halaman input awal
      session()->forget('nilaiId', 'idGrupCabang', 'idGrupSantri', 'idGrupKelompok', 'namaJuz', 'namaLevel');
      return redirect()->route('guru.perkembanganTahfidz');
  }

  public function editPTahfidz(Request $request, $id)
  {
    $request->validate([
      'ayat' => 'required|string',
      'keterangan' => 'nullable|string',
    ]);

    DB::table('nilai_ptahfidz')->where('id', $id)->update([
      'ayat' => $request->ayat,
      'keterangan' => $request->keterangan,
      'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Nilai PTahfidz Berhasil Diperbarui');
  }

  public function hapusPTahfidz($id)
  {
    DB::table('nilai_ptahfidz')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
  }

  // Simpan data ke tabel nilai_murojaah
  public function simpanMurojaah(Request $request)
  {
        $guruId = Auth::user()->id;
    
        // Validasi input
        $request->validate([
            'id_santri' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'juz' => 'required',
            'nama_surah' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);
    
        // Cek apakah data dengan id_santri, tanggal, dan waktu yang sama sudah ada di tabel
        $exists = DB::table('nilai_murojaah')
                    ->where('id_santri', $request->id_santri)
                    ->where('tanggal', $request->tanggal)
                    ->where('waktu', $request->waktu)
                    ->exists();
    
        if ($exists) {
            return redirect()->back()->with('error', 'Santri Tersebut Sudah Memiliki Nilai Pada Tanggal dan Waktu yang Sama.');
        }
    
        // Simpan data baru
        DB::table('nilai_murojaah')->insert([
            'id_guru' => $guruId,
            'id_santri' => $request->id_santri,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'juz' => $request->juz,
            'nama_surah' => $request->nama_surah,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Nilai Murojaah Berhasil Disimpan');
  }

  public function editMurojaah(Request $request, $id)
  {
    $request->validate([
      'tanggal' => 'required|date',
      'waktu' => 'required|date_format:H:i',
      'juz' => 'required',
      'nama_surah' => 'required|string',
      'keterangan' => 'nullable|string',
    ]);

    DB::table('nilai_murojaah')->where('id', $id)->update([
      'tanggal' => $request->tanggal,
      'waktu' => $request->waktu,
      'juz' => $request->juz,
      'nama_surah' => $request->nama_surah,
      'keterangan' => $request->keterangan,
      'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Nilai Murojaah Berhasil Diperbarui');
  }

  public function hapusMurojaah($id)
  {
    DB::table('nilai_murojaah')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Nilai Murojaah Berhasil Dihapus');
  }

  // Simpan data ke tabel nilai_tasmi
  public function simpanTasmi(Request $request)
  {
        $guruId = Auth::user()->id;
    
        // Validasi input
        $request->validate([
            'id_santri' => 'required',
            'juz' => 'required',
            'status' => 'required',
            'tajwid1' => 'required|integer',
            'tajwid2' => 'required|integer',
            'tajwid3' => 'required|integer',
            'tajwid4' => 'required|integer',
            'fashohah1' => 'required|integer',
            'fashohah2' => 'required|integer',
            'fashohah3' => 'required|integer',
            'fashohah4' => 'required|integer',
        ]);
    
        // Cek apakah data dengan id_santri dan juz sudah ada
        $exists = DB::table('nilai_tasmi')
                    ->where('id_santri', $request->id_santri)
                    ->where('juz', $request->juz)
                    ->exists();
    
        if ($exists) {
            return redirect()->back()->with('error', "Sudah Ada Nilai Pada Juz {$request->juz} dan Santri Tersebut");
        }

    
        // Simpan data baru
        DB::table('nilai_tasmi')->insert([
            'id_guru' => $guruId,
            'id_santri' => $request->id_santri,
            'juz' => $request->juz,
            'tajwid1' => $request->tajwid1,
            'tajwid2' => $request->tajwid2,
            'tajwid3' => $request->tajwid3,
            'tajwid4' => $request->tajwid4,
            'fashohah1' => $request->fashohah1,
            'fashohah2' => $request->fashohah2,
            'fashohah3' => $request->fashohah3,
            'fashohah4' => $request->fashohah4,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Nilai Tasmi Berhasil Disimpan');
  }

  public function editTasmi(Request $request, $id)
  {
    $request->validate([
      'juz' => 'required',
      'tajwid1' => 'required|integer',
      'tajwid2' => 'required|integer',
      'tajwid3' => 'required|integer',
      'tajwid4' => 'required|integer',
      'fashohah1' => 'required|integer',
      'fashohah2' => 'required|integer',
      'fashohah3' => 'required|integer',
      'fashohah4' => 'required|integer',
    ]);

    DB::table('nilai_tasmi')->where('id', $id)->update([
      'juz' => $request->juz,
      'tajwid1' => $request->tajwid1,
      'tajwid2' => $request->tajwid2,
      'tajwid3' => $request->tajwid3,
      'tajwid4' => $request->tajwid4,
      'fashohah1' => $request->fashohah1,
      'fashohah2' => $request->fashohah2,
      'fashohah3' => $request->fashohah3,
      'fashohah4' => $request->fashohah4,
      'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Nilai Tasmi Berhasil Diperbarui');
  }

  public function hapusTasmi($id)
  {
    DB::table('nilai_tasmi')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Nilai Tasmi Berhasil Dihapus');
  }

  public function perkembanganTahsin()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Ambil data dari tabel nilai_ptahsin dengan join ke tabel users dan data_santri
    $data = DB::table('nilai_ptahsin')
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
      )
      ->get();
    // Kirim data ke view
    return view('guru.perkembangan-tahsin', compact('data'));
  }

  public function perkembanganTahfidz()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Ambil data dari tabel nilai_ptahfidz dengan join ke tabel users, data_santri, juz, dan juz_surat
    $data = DB::table('nilai_ptahfidz')
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
      )
      ->get();

    // Kirim data ke view
    return view('guru.perkembangan-tahfidz', compact('data'));
  }

  public function munaqasyahTahsin()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Ambil data dari tabel nilai_ptahfidz dengan join ke tabel users, data_santri, juz, dan juz_surat
    $data = DB::table('nilai_mtahsin')
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
      )
      ->get();

    // Kirim data ke view
    return view('guru.munaqasyah-tahsin', compact('data'));
  }

  public function munaqasyahTahfidz()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Ambil data dari tabel nilai_mtahfidz dengan join ke tabel users, data_santri, juz, dan juz_surat
    $data = DB::table('nilai_mtahfidz')
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
      )
      ->get();

    // Kirim data ke view
    return view('guru.munaqasyah-tahfidz', compact('data'));
  }

  public function murojaah()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Ambil data dari tabel nilai_ptahfidz dengan join ke tabel users, data_santri, juz, dan juz_surat
    $data = DB::table('nilai_murojaah')
      ->join('users', 'nilai_murojaah.id_guru', '=', 'users.id')
      ->join('data_santri', 'nilai_murojaah.id_santri', '=', 'data_santri.id')
      ->where('nilai_murojaah.id_guru', $userId)
      ->select(
        'nilai_murojaah.id',
        'nilai_murojaah.id_guru',
        'nilai_murojaah.id_santri',
        'nilai_murojaah.tanggal',
        'nilai_murojaah.waktu',
        'nilai_murojaah.juz',
        'nilai_murojaah.nama_surah',
        'nilai_murojaah.keterangan',
        'nilai_murojaah.created_at',
        'users.nama_lengkap as nama_guru',
        'data_santri.nama_lengkap as nama_santri'
      )
      ->get();

    // Kirim data ke view
    return view('guru.murojaah', compact('data'));
  }

  public function tasmi()
  {
    // Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Ambil data dari tabel nilai_ptahfidz dengan join ke tabel users, data_santri, juz, dan juz_surat
    $data = DB::table('nilai_tasmi')
      ->join('users', 'nilai_tasmi.id_guru', '=', 'users.id')
      ->join('data_santri', 'nilai_tasmi.id_santri', '=', 'data_santri.id')
      ->where('nilai_tasmi.id_guru', $userId)
      ->select(
        'nilai_tasmi.id',
        'nilai_tasmi.id_guru',
        'nilai_tasmi.id_santri',
        'nilai_tasmi.juz',
        'nilai_tasmi.tajwid1',
        'nilai_tasmi.tajwid2',
        'nilai_tasmi.tajwid3',
        'nilai_tasmi.tajwid4',
        'nilai_tasmi.fashohah1',
        'nilai_tasmi.fashohah2',
        'nilai_tasmi.fashohah3',
        'nilai_tasmi.fashohah4',
        'nilai_tasmi.created_at',
        'users.nama_lengkap as nama_guru',
        'data_santri.nama_lengkap as nama_santri'
      )
      ->get();

    // Kirim data ke view
    return view('guru.tasmi', compact('data'));
  }

  // Simpan data tabel ke nilai m_tahfidz
  public function simpanMTahfidz(Request $request)
  {
    $guruId = Auth::user()->id;

    // Validasi input
    $request->validate([
        'grup_santri' => 'required',
        'id_santri' => 'required',
        'tanggal' => 'required|date',
        'juz' => 'required',
        'id_juz' => 'required',
        'id_juz_level' => 'required',
        'pengetahuan' => 'required|integer',
        'fashohah' => 'required|integer',
        'tajwid' => 'required|integer',
    ]);

    // Cek apakah sudah ada nilai santri untuk surah yang sama
    $exists = DB::table('nilai_mtahfidz')
                ->where('id_santri', $request->id_santri)
                ->where('id_juz_level', $request->id_juz_level)
                ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Santri Tersebut Sudah Memiliki Nilai Pada Surah yang Sama.');
    }
      
    $nilaiId = DB::table('nilai_mtahfidz')->insertGetId([
              'id_guru' => $guruId,
              'id_santri' => $request->id_santri,
              'tanggal' => $request->tanggal,
              'juz' => $request->juz,
              'id_juz' => $request->id_juz,
              'id_juz_level' => $request->id_juz_level,
              'pengetahuan' => $request->pengetahuan,
              'fashohah' => $request->fashohah,
              'tajwid' => $request->tajwid,
              'created_at' => now(),
              'updated_at' => now(),
    ]);

    // Ambil data surah untuk dropdown berdasarkan level yang dipilih
    $surahData = DB::table('juz_surat')
        ->select('id', 'nama_surat')
        ->where('id_juz_level', $request->id_juz_level)
        ->get()
        ->toArray();

    // Menyimpan informasi dalam session untuk digunakan nanti
    session([
        'nilaiId' => $nilaiId,
        'id_guru' => $guruId,
        'grup_santri' => $request->grup_santri,
        'id_santri' => $request->id_santri,
        'tanggal' => $request->tanggal,
        'juz' => $request->juz,
        'id_juz' => $request->id_juz,
        'id_juz_level' => $request->id_juz_level,
        'surah_data' => $surahData,
    ]);

    // Update selected_surah di session
    $selectedSurah = session('selected_surah', []);
    $selectedSurah[] = $request->id_juz_level;
    session(['selected_surah' => $selectedSurah]);

      return redirect()->back()->with('success', 'Penilaian berhasil disimpan, lanjutkan penilaian!');
  }

  // Simpan data nilai lanjutan ke tabel m_tahfidz
  public function simpanDataLanjutanMTahfidz(Request $request)
  {
    $request->validate([
      'id_juz_level' => 'required',
      'pengetahuan' => 'required|integer',
      'fashohah' => 'required|integer',
      'tajwid' => 'required|integer',
    ]);

    // Ambil data dari sesi untuk data awal
    $guruId = session('id_guru');
    $grupSantri = session('grup_santri');
    $idSantri = session('id_santri');
    $tanggal = session('tanggal');
    $juz = session('juz');
    $idJuz = session('id_juz');

    // Cek apakah sudah ada nilai santri untuk surah yang sama
    $exists = DB::table('nilai_mtahfidz')
      ->where('id_santri', $idSantri)
      ->where('id_juz_level', $request->id_juz_level)
      ->exists();

      if ($exists) {
        return redirect()->back()->with('error', 'Santri Sudah Memiliki Nilai Pada Surah yang Sama');
    }

    // Ambil data nama grup, santri, juz dan level
    $namaGrup = DB::table('grup_santri')
          ->where('id', $grupSantri)
          ->first(['id', 'nama_grup']);

    $namaSantri = DB::table('data_santri')
          ->where('id', $idSantri)
          ->first(['id', 'id_grup_santri', 'nama_lengkap']);

    $namaJuz = DB::table('juz')
          ->where('id', $juz)
          ->first(['id', 'nama_juz']);

    $namaLevel = DB::table('juz_level')
          ->where('id', $idJuz)
          ->first(['id', 'id_juz', 'level']);

    // Cek data dalam session
    if ($namaGrup->isNotEmpty() && $namaSantri->isNotEmpty() && $namaJuz->isNotEmpty() && $namaLevel->isNotEmpty()) {
      session([
        'namaGrup' => $namaGrup,
        'namaSantri' => $namaSantri,
        'namaJuz' => $namaJuz,
        'namaLevel' => $namaLevel,
      ]);
    } else {
      return redirect()->back()->with('error', 'Data Kosong');
    }
    
    // Simpan data lanjutan dengan informasi surah
    DB::table('nilai_mtahfidz')->insert([
          'id_guru' => $guruId,
          'id_santri' => $idSantri,
          'tanggal' => $tanggal,
          'juz' => $juz,
          'id_juz' => $idJuz,
          'id_juz_level' => $request->id_juz_level,
          'pengetahuan' => $request->pengetahuan,
          'fashohah' => $request->fashohah,
          'tajwid' => $request->tajwid,
          'created_at' => now(),
          'updated_at' => now(),
    ]);

    // Update selected_surah di session
    $selectedSurah = session('selected_surah', []);
    $selectedSurah[] = $request->id_juz_level;
    session(['selected_surah' => $selectedSurah]);

    return redirect()->back()->with('success', 'Penilaian berhasil disimpan, lanjutkan penilaian!');
  }

  // Reset data untuk menambahkan data baru m_tahfidz
  public function tambahDataAwal()
  {
      // Hapus data session jika ada dan arahkan ke halaman input awal
      session()->forget('nilaiId', 'namaGrup', 'namaSantri', 'namaJuz', 'namaLevel');
      return redirect()->route('guru.munaqasyahTahfidz');
  }

  public function hapusMTahfidz($id)
  {
    // Cari data berdasarkan ID
    $data = DB::table('nilai_mtahfidz')->where('id', $id)->first();

    if (!$data) {
      return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // Hapus data
    DB::table('nilai_mtahfidz')->where('id', $id)->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus.');
  }

  public function getGrupCabang()
  {
    // Ambil data dari tabel kelas
    $grupCabang = DB::table('grup_cabang')
      ->select('id', 'nama_grup', 'alamat_grup')
      ->get();

      return response()->json($grupCabang);
  }

  public function getGrupSantri($id_cabang)
  {
    $grupSantri = DB::table('grup_santri')
      ->where('id_cabang', $id_cabang)
      ->select('id', 'nama_grup')
      ->get();

    return response()->json($grupSantri);
  }

  public function getGrupKelompok($id_rombel)
  {
    $grupKelompok = DB::table('kelompok_quran')
      ->where('id_rombel', $id_rombel)
      ->select('id', 'nama_kelompok')
      ->get();

    return response()->json($grupKelompok);
  }

  public function getDataSantriByGrup($id_grup_kelompok)
  {
    // Ambil data santri berdasarkan id_grup_santri
    $dataSantri = DB::table('data_santri')
      ->where('id_grup_kelompok', $id_grup_kelompok)
      ->select('id', 'nama_lengkap')
      ->get();

    // Return data dalam format JSON
    return response()->json($dataSantri);
  }

  public function getDataJuz()
  {
    $dataJuz = DB::table('juz')
      ->select('id', 'nama_juz')
      ->get();

    return response()->json($dataJuz);
  }

  public function getDataLevel($id_juz)
  {
    // Validasi apakah id ada di tabel juz
    $isJuzExists = DB::table('juz')->where('id', $id_juz)->exists();

    if (!$isJuzExists) {
      return response()->json([
        'message' => 'Juz tidak ditemukan.'
      ], 404);
    }

    $dataLevel = DB::table('juz_level')
      ->select('id', 'level')
      ->where('id_juz', $id_juz)
      ->get();

    return response()->json($dataLevel);
  }

  public function getDataSurah($id_juz_level)
  {
    // Validasi apakah id_juz_level ada di tabel juz_level
    $isJuzLevelExists = DB::table('juz_surat')->where('id', $id_juz_level)->exists();

    if (!$isJuzLevelExists) {
      return response()->json([
        'message' => 'Level untuk Juz tidak ditemukan.'
      ], 404);
    }

    $dataSurah = DB::table('juz_surat')
      ->select('id', 'nama_surat')
      ->where('id_juz_level', $id_juz_level)
      ->get();

    return response()->json($dataSurah);
  }

  public function updateSantriData()
  {
      // Ambil id_juz dari session
      $idKelompok = session('idGrupKelompok');
      $selectedSantri = session('selected_santri', []);

      if (!$idKelompok) {
          return response()->json([
              'success' => false,
              'message' => 'ID Santri tidak ditemukan dalam session.',
          ], 400);
      }

      // Menampilkan data santri yang sesuai dengan id_grup_kelompok
      $santriData = DB::table('data_santri')
        ->where('id_grup_kelompok', $idKelompok)
        ->select('id', 'nama_lengkap')
        ->get();

        if ($santriData->isEmpty()) {
          return response()->json([
                'success' => false,
                'message' => 'Tidak ada data surah yang tersedia untuk ID Juz ini.',
          ], 404);
      }

      // Filter santri yang belum dipilih
      $filteredSantriData = $santriData->reject(function ($santri) use ($selectedSantri) {
          return in_array($santri->id, $selectedSantri);
      })->values();

      return response()->json([
          'success' => true,
          'santri_data' => $filteredSantriData,
          'selected_santri' => $selectedSantri,
      ]);
  }

  public function updateSurahData()
  {
      // Ambil id_juz dari session
      $idJuz = session('id_juz');
      $selectedSurah = session('selected_surah', []);

      if (!$idJuz) {
          return response()->json([
              'success' => false,
              'message' => 'ID Juz tidak ditemukan dalam session.',
          ], 400);
      }

      // Menampilkan data surah yang sesuai dengan id_juz 
      $surahData = DB::table('juz_surat')
          ->where('id_juz_level', $idJuz)
          ->get(['id', 'nama_surat']);

        if ($surahData->isEmpty()) {
          return response()->json([
                'success' => false,
                'message' => 'Tidak ada data surah yang tersedia untuk ID Juz ini.',
          ], 404);
      }

      // Filter surah yang belum dipilih
      $filteredSurahData = $surahData->reject(function ($surah) use ($selectedSurah) {
          return in_array($surah->id, $selectedSurah);
      })->values();

      return response()->json([
          'success' => true,
          'surah_data' => $filteredSurahData,
          'selected_surah' => $selectedSurah,
      ]);
  }
}
