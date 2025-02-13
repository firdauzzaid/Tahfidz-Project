<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaJuz extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel juz, diurutkan berdasarkan nama_juz
        $juz = DB::table('juz')
            ->select('id', 'nama_juz as juz')
            ->orderBy('nama_juz', 'asc') // Urutkan berdasarkan nama_juz secara ascending
            ->get();
    
        // Mengambil data distinct dari tabel juz_level
        $levels = DB::table('juz_level')
            ->select('id', DB::raw('level'))
            ->get();
    
        // Mengambil data distinct dari tabel juz_surat
        $surah = DB::table('juz_surat')
            ->select('id', DB::raw('nama_surat'))
            ->get();
    
        // Mengambil data gabungan dari tabel juz, juz_level, dan juz_surat, diurutkan berdasarkan nama_juz
        $data = DB::table('juz')
            ->leftJoin('juz_level', 'juz.id', '=', 'juz_level.id_juz')
            ->leftJoin('juz_surat', 'juz_level.id', '=', 'juz_surat.id_juz_level')
            ->select(
                'juz.id as juz_id',
                'juz.nama_juz',
                'juz_level.id as level_id',
                'juz_level.level as level_name',
                DB::raw('GROUP_CONCAT(juz_surat.nama_surat ORDER BY juz_surat.id ASC SEPARATOR ", ") as surahs')
            )
            ->groupBy('juz.id', 'juz.nama_juz', 'juz_level.id', 'juz_level.level')
            ->orderBy('juz.nama_juz', 'asc') // Urutkan berdasarkan nama_juz secara ascending
            ->get()
            ->groupBy('juz_id'); // Mengelompokkan data berdasarkan ID Juz
    
        // Mengirim data ke view admin.kelola-juz
        return view('admin.kelola-juz', [
            'juz' => $juz,
            'levels' => $levels,
            'surah' => $surah,
            'data' => $data,
        ]);
    }

  // 1. Tambah Data Juz
    public function tambahJuz(Request $request)
    {
        $request->validate([
            'nama_juz' => 'required|array',  // Validasi agar nama_juz berupa array
            'nama_juz.*' => 'string|max:255', // Validasi setiap elemen dalam array nama_juz
        ]);
    
        // Ambil nilai nama_juz dari request
        $namaJuzArray = $request->nama_juz;
    
        // Iterasi setiap nama_juz yang dikirimkan
        foreach ($namaJuzArray as $namaJuz) {
            // Cek apakah nama_juz sudah ada
            $exists = DB::table('juz')->where('nama_juz', $namaJuz)->exists();
    
            if ($exists) {
                // Jika ada nama_juz yang sudah ada, kembalikan error
                return redirect()->back()->withErrors(['nama_juz' => 'Sudah Ada Nama Juz Yang Sama'])->withInput();
            }
    
            // Tambahkan data ke tabel juz
            DB::table('juz')->insert([
                'nama_juz' => $namaJuz,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        // Redirect setelah berhasil menambahkan data
        return redirect()->route('admin.kelola-juz')->with('success', 'Data Juz berhasil ditambahkan.');
    }


  // 2. Edit Data Juz
  public function editJuz(Request $request, $id)
  {
      $request->validate([
          'nama_juz' => 'required|string|max:255',
      ]);

      DB::table('juz')
          ->where('id', $id)
          ->update([
              'nama_juz' => $request->nama_juz,
              'updated_at' => now(),
          ]);

      return redirect()->route('admin.kelola-juz')->with('success', 'Data Juz berhasil diperbarui.');
  }

  // 3. Hapus Data Juz
    public function hapusJuz($id)
    {
        // Hapus data terkait di tabel juz_level dan juz_surat
        $juzLevels = DB::table('juz_level')->where('id_juz', $id)->get();
    
        // Hapus data pada tabel juz_surat berdasarkan id_juz_level
        foreach ($juzLevels as $level) {
            DB::table('juz_surat')->where('id_juz_level', $level->id)->delete();
        }
    
        // Hapus data pada tabel juz_level
        DB::table('juz_level')->where('id_juz', $id)->delete();
    
        // Hapus data pada tabel juz
        DB::table('juz')->where('id', $id)->delete();
    
        return redirect()->route('admin.kelola-juz')->with('success', 'Data Juz dan data terkait berhasil dihapus.');
    }


  // 4. Tambah Data Level
    public function tambahLevel(Request $request)
    {
        $request->validate([
            'id_juz' => 'required|array', // Mengharuskan 'id_juz' berupa array
            'id_juz.*' => 'exists:juz,id', // Memastikan setiap id_juz ada di tabel juz
            'level' => 'required|array', // Mengharuskan 'level' berupa array
            'level.*' => 'string|max:255', // Menambahkan validasi untuk setiap elemen dalam array level
        ]);
    
        // Ambil nilai id_juz dan level dari request
        $idJuz = $request->id_juz;
        $levels = $request->level;
    
        // Iterasi setiap level yang dikirimkan
        foreach ($idJuz as $juzId) {
            foreach ($levels as $level) {
                // Cek apakah level sudah ada untuk id_juz tertentu
                $exists = DB::table('juz_level')
                    ->where('id_juz', $juzId)
                    ->where('level', $level)
                    ->exists();
    
                if ($exists) {
                    // Jika ada level yang sudah ada, kembalikan error
                    return redirect()->back()->withErrors(['level' => 'Sudah ada level dengan nama yang sama'])->withInput();
                }
    
                // Tambahkan data level ke tabel juz_level
                DB::table('juz_level')->insert([
                    'id_juz' => $juzId,
                    'level' => $level,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        // Redirect setelah berhasil menambahkan data
        return redirect()->route('admin.kelola-juz')->with('success', 'Data Level berhasil ditambahkan.');
    }

  // 5. Edit Data Level
  public function editLevel(Request $request, $id_juz)
  {
      $request->validate([
          'level' => 'required|string|max:255',
      ]);

      DB::table('juz_level')
          ->where('id_juz', $id_juz)
          ->update([
              'level' => $request->level,
              'updated_at' => now(),
          ]);

      return redirect()->route('admin.kelola-juz')->with('success', 'Data Level berhasil diperbarui.');
  }

  // 6. Hapus Data Level
  public function hapusLevel($id_juz)
  {
      DB::table('juz_level')->where('id_juz', $id_juz)->delete();

      return redirect()->route('admin.kelola-juz')->with('success', 'Data Level berhasil dihapus.');
  }

  // 7. Tambah Data Surat
    public function tambahSurat(Request $request)
    {
        $request->validate([
            'id_juz_level' => 'required|exists:juz_level,id',
            'nama_surat' => 'required|array|min:1', // Validate as an array
            'nama_surat.*' => 'string|max:255', // Each surah name should be a string
        ]);
    
        // Insert each selected surah into the database
        foreach ($request->nama_surat as $surah) {
            DB::table('juz_surat')->insert([
                'id_juz_level' => $request->id_juz_level,
                'nama_surat' => $surah,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        return redirect()->route('admin.kelola-juz')->with('success', 'Data Surah berhasil ditambahkan.');
    }

  // 8. Edit Data Surat
  public function editSurat(Request $request, $id_juz_level)
  {
      $request->validate([
          'nama_surat' => 'required|string|max:255',
      ]);

      DB::table('juz_surat')
          ->where('id_juz_level', $id_juz_level)
          ->update([
              'nama_surat' => $request->nama_surat,
              'updated_at' => now(),
          ]);

      return redirect()->route('admin.kelola-juz')->with('success', 'Data Surah berhasil diperbarui.');
  }

  // 9. Hapus Data Surat
  public function hapusSurat($id_juz_level)
  {
      DB::table('juz_surat')->where('id_juz_level', $id_juz_level)->delete();

      return redirect()->route('admin.kelola-juz')->with('success', 'Data Surah berhasil dihapus.');
  }

  public function getLevels($id_juz)
  {
      $levels = DB::table('juz_level')
          ->where('id_juz', $id_juz)
          ->select('id', 'level')
          ->get();

      return response()->json($levels);
  }
}
