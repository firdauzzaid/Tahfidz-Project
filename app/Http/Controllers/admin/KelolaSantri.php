<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KelolaSantri extends Controller
{
  /**
   * Redirect to user-management view.
   *
   */
  public function KelolaSantri()
  {
    // Ambil data dari tabel kelas
    $grupCabang = DB::table('grup_cabang')
      ->select('id', 'nama_grup', 'alamat_grup')
      ->get();

    // Ambil data dari tabel Rombel
    $grupSantri = DB::table('grup_santri')
      ->select('id', 'id_cabang', 'nama_grup')
      ->get();

    // Ambil data dari tabel Kelompok Qur'an
    $grupKelompok = DB::table('kelompok_quran')
      ->select('id', 'id_rombel', 'nama_kelompok')
      ->get();

    // Kirim data ke view
    return view('admin.kelola-santri', compact('grupCabang', 'grupSantri', 'grupKelompok'));
  }

  // Ambil grup_santri berdasarkan id_cabang yang dipilih
  public function getDataRombel($id_cabang)
  {
        $grupSantriCabang = DB::table('grup_santri')
            ->where('id_cabang', $id_cabang)
            ->get();

        return response()->json([
            'success' => count($grupSantriCabang) > 0,
            'rombel_data' => $grupSantriCabang
        ]);
  }

  // Ambil grup_santri berdasarkan id_rombel yang dipilih
  public function getDataKelompokQuran($id_rombel)
  {
        $grupSantriKelompokQuran = DB::table('kelompok_quran')
            ->where('id_rombel', $id_rombel)
            ->get();

        return response()->json([
            'success' => count($grupSantriKelompokQuran) > 0,
            'kelompok_quran_data' => $grupSantriKelompokQuran
        ]);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $columns = [
      1 => 'id',
      2 => 'no_identitas',
      3 => 'nama_lengkap',
      4 => 'alamat',
      5 => 'keterangan',
      6 => 'status',
      7 => 'created_at'
    ];

    // Hitung total data dengan level selain 2
    $totalData = DB::table('data_santri')->count();

    $totalFiltered = $totalData;

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    if (empty($request->input('search.value'))) {
      $data_santri = DB::table('data_santri')
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $search = $request->input('search.value');

      $data_santri = DB::table('data_santri')
        ->where(function ($query) use ($search) {
          $query->where('id', 'LIKE', "%{$search}%")
            ->orWhere('no_identitas', 'LIKE', "%{$search}%")
            ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
            ->orWhere('alamat', 'LIKE', "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = DB::table('data_santri')
        ->where(function ($query) use ($search) {
          $query->where('id', 'LIKE', "%{$search}%")
            ->orWhere('no_identitas', 'LIKE', "%{$search}%")
            ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
            ->orWhere('alamat', 'LIKE', "%{$search}%");
        })
        ->count();
    }

    $data = [];

    if (!empty($data_santri)) {
      $ids = $start;

      foreach ($data_santri as $user) {
        $nestedData['id'] = $user->id;
        $nestedData['fake_id'] = ++$ids;
        $nestedData['no_identitas'] = $user->no_identitas;
        $nestedData['nama_lengkap'] = $user->nama_lengkap;
        $nestedData['alamat'] = $user->alamat;
        $nestedData['keterangan'] = $user->keterangan;
        $nestedData['status'] = $user->status;
        $nestedData['created_at'] = $user->created_at;

        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => intval($totalData),
        'recordsFiltered' => intval($totalFiltered),
        'code' => 200,
        'data' => $data,
      ]);
    } else {
      return response()->json([
        'message' => 'Internal Server Error',
        'code' => 500,
        'data' => [],
      ]);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $userID = $request->id;

      try {
        if ($userID) {
          // Validasi input
          $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_identitas' => 'required|string|max:50|unique:data_santri,no_identitas',
            'alamat' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-Laki,Perempuan',
            'keterangan' => 'nullable|string|max:255',
            'grup_cabang' => 'required|exists:grup_cabang,id',
            'grup_santri' => 'required|exists:grup_santri,id',
            'grup_kelompok' => 'required|exists:grup_kelompok,id',
            'status' => 'required|in:0,1',
            'nama_wali_ayah' => 'required|string|max:255',
            'telepon_wali_ayah' => 'required|string|max:15',
            'alamat_wali_ayah' => 'required|string|max:255',
            'nama_wali_ibu' => 'required|string|max:255',
            'telepon_wali_ibu' => 'required|string|max:15',
            'alamat_wali_ibu' => 'required|string|max:255',
          ]);
        }

        DB::beginTransaction();

        // Validasi kuota grup santri
        $totalSantri = DB::table('data_santri')->where('id_grup_santri', $validated['grup_santri'])->count();
        $maxKuota = DB::table('grup_santri')->where('id', $validated['grup_santri'])->value('jumlah_maksimal');

        if ($totalSantri >= $maxKuota) {
            return response()->json(['message' => 'Kuota grup santri penuh', 'status' => 'quota_full'], 422);
        }

        // Simpan data santri
        $santriId = DB::table('data_santri')->insertGetId([
            'nama_lengkap' => $validated['nama_lengkap'],
            'no_identitas' => $validated['no_identitas'],
            'alamat' => $validated['alamat'],
            'tgl_lahir' => $validated['tgl_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'keterangan' => $validated['keterangan'],
            'id_grup_cabang' => $validated['grup_cabang'],
            'id_grup_santri' => $validated['grup_santri'],
            'id_grup_kelompok' => $validated['grup_kelompok'],
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat username wali
        $usernameWaliAyah = strtolower(str_replace(' ', '', $validated['nama_wali_ayah'])) . rand(100, 999);
        $usernameWaliIbu = strtolower(str_replace(' ', '', $validated['nama_wali_ibu'])) . rand(100, 999);

        // Simpan data wali
        $waliAyahId = DB::table('data_walisantri')->insertGetId([
            'id_santri' => $santriId,
            'no_identitas' => $usernameWaliAyah,
            'hubungan' => 'Ayah',
            'nama_wali' => $validated['nama_wali_ayah'],
            'telepon' => $validated['telepon_wali_ayah'],
            'alamat' => $validated['alamat_wali_ayah'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $waliIbuId = DB::table('data_walisantri')->insertGetId([
            'id_santri' => $santriId,
            'no_identitas' => $usernameWaliIbu,
            'hubungan' => 'Ibu',
            'nama_wali' => $validated['nama_wali_ibu'],
            'telepon' => $validated['telepon_wali_ibu'],
            'alamat' => $validated['alamat_wali_ibu'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat akun untuk wali
        DB::table('users')->insert([
            [
                'username' => $usernameWaliAyah,
                'id_wali' => $waliAyahId,
                'nama_lengkap' => $validated['nama_wali_ayah'],
                'email' => $usernameWaliAyah . '@gmail.com',
                'password' => bcrypt($usernameWaliAyah),
                'level' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => $usernameWaliIbu,
                'id_wali' => $waliIbuId,
                'nama_lengkap' => $validated['nama_wali_ibu'],
                'email' => $usernameWaliIbu . '@gmail.com',
                'password' => bcrypt($usernameWaliIbu),
                'level' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
        DB::commit();

        dd();

        return response()->json(['message' => 'Data santri dan wali berhasil ditambahkan', 'status' => 'created']);
      } catch (\Exception $e) {
          DB::rollBack();
          return response()->json(['message' => 'Gagal menambahkan data', 'error' => $e->getMessage(), 'status' => 'create_failed'], 500);
          // return response()->json(['message' => 'Gagal menambahkan data', 'error' => $e->getMessage(), 'status' => 'create_failed'], 500);
      }
  }  

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id): JsonResponse
  {
    $user = DB::table('data_santri')->where('id', $id)->first();

    if ($user) {
      return response()->json($user);
    } else {
      return response()->json(['message' => 'User not found'], 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $deleted = DB::table('data_santri')->where('id', $id)->delete();

    if ($deleted) {
      return response()->json(['message' => 'User deleted successfully'], 200);
    } else {
      return response()->json(['message' => 'User not found or deletion failed'], 404);
    }
  }

  public function selectPengguna()
  {
    // Ambil semua data id dan hp dari tabel users
    $users = DB::table('data_santri')->select('id', 'nama_lengkap_lengkap', 'email')->get();

    // Kembalikan data dalam bentuk JSON
    return response()->json($users);
  }

  public function detailSantri($id)
  {
    // Ambil data santri dengan join tabel grup_cabang dan grup_santri
    $detailSantri = DB::table('data_santri')
      ->leftJoin('grup_cabang', 'data_santri.id_grup_cabang', '=', 'grup_cabang.id')
      ->leftJoin('grup_santri', 'data_santri.id_grup_santri', '=', 'grup_santri.id')
      ->leftJoin('kelompok_quran', 'data_santri.id_grup_kelompok', '=', 'kelompok_quran.id')
      ->where('data_santri.id', $id)
      ->select(
        'data_santri.*',
        'grup_cabang.nama_grup as nama_grup_cabang',
        'grup_cabang.alamat_grup as alamat_grup_cabang',
        'grup_santri.nama_grup as nama_grup_santri',
        'grup_santri.jumlah_maksimal as jumlah_maksimal_grup_santri',
        'kelompok_quran.nama_kelompok as nama_kelompok_quran',
        'kelompok_quran.jumlah as jumlah_kelompok_quran'
      )
      ->first();

    // Jika data santri ditemukan
    if ($detailSantri) {
      // Ambil data wali ayah
      $waliAyah = DB::table('data_walisantri')
        ->where('id_santri', $id)
        ->where('hubungan', 'Ayah')
        ->select('no_identitas', 'nama_wali', 'telepon', 'alamat')
        ->first();

      // Ambil data wali ibu
      $waliIbu = DB::table('data_walisantri')
        ->where('id_santri', $id)
        ->where('hubungan', 'Ibu')
        ->select('no_identitas', 'nama_wali',  'telepon', 'alamat')
        ->first();

      // Ambil data dari tabel grup_cabang
      $grupCabang = DB::table('grup_cabang')
        ->select('id', 'nama_grup', 'alamat_grup')
        ->get();

      // Ambil data dari tabel grup_santri
      $grupSantri = DB::table('grup_santri')
        ->select('id', 'nama_grup', 'jumlah_maksimal')
        ->get();

      $grupKelompok = DB::table('kelompok_quran')
        ->select('id', 'nama_kelompok', 'jumlah')
        ->get();

      // Kirim data ke view
      return view('admin.detail-santri', [
        'detailSantri' => $detailSantri,
        'waliAyah' => $waliAyah,
        'waliIbu' => $waliIbu,
        'grupCabang' => $grupCabang,
        'grupSantri' => $grupSantri,
        'grupKelompok' =>$grupKelompok
      ]);
    } else {
      // Jika data tidak ditemukan, redirect dengan pesan error
      return redirect()->route('admin.kelola-santri')->with('error', 'Santri tidak ditemukan.');
    }
  }

  public function editdataSantri(Request $request)
  {
    // Validasi input
    $request->validate([
      'id' => 'required|exists:data_santri,id',
      'nama_lengkap' => 'required|string|max:255',
      'no_identitas' => 'required|string|max:50',
      'alamat' => 'required|string|max:255',
      'tgl_lahir' => 'required|date',
      'jenis_kelamin' => 'required|string|in:Laki-Laki,Perempuan',
      'keterangan' => 'nullable|string|max:255',
      'grup_cabang' => 'required|exists:grup_cabang,id',
      'grup_santri' => 'required|exists:grup_santri,id',
      'kelompok_quran' => 'required|exists:kelompok_quran,id',
      'status' => 'required|in:0,1',
      'nama_wali_ayah' => 'required|string|max:50',
      'telepon_wali_ayah' => 'required|string|max:15',
      'alamat_wali_ayah' => 'required|string|max:255',
      'nama_wali_ibu' => 'required|string|max:50',
      'telepon_wali_ibu' => 'required|string|max:15',
      'alamat_wali_ibu' => 'required|string|max:255',
    ]);

    // DB::beginTransaction(); // Mulai transaksi

    // Data dari request
    $id = $request->input('id');
    $nama_lengkap = $request->input('nama_lengkap');
    $no_identitas = $request->input('no_identitas');
    $alamat = $request->input('alamat');
    $tgl_lahir = $request->input('tgl_lahir');
    $jenis_kelamin = $request->input('jenis_kelamin');
    $keterangan = $request->input('keterangan');
    $grup_cabang = $request->input('grup_cabang');
    $grup_santri = $request->input('grup_santri');
    $kelompok_quran = $request->input('kelompok_quran');
    $status = $request->input('status');
    $nama_wali_ayah = $request->input('nama_wali_ayah');
    $telepon_wali_ayah = $request->input('telepon_wali_ayah');
    $alamat_wali_ayah = $request->input('alamat_wali_ayah');
    $nama_wali_ibu = $request->input('nama_wali_ibu');
    $telepon_wali_ibu = $request->input('telepon_wali_ibu');
    $alamat_wali_ibu = $request->input('alamat_wali_ibu');

    try {
      // Periksa apakah no_identitas sudah ada dan cukup update
      $existingSantri = DB::table('data_santri')
        ->where('no_identitas', $no_identitas)
        ->where('id', '!=', $id)
        ->first();

      if ($existingSantri) {
        return redirect()->back()->with('error', 'No Identitas Santri sudah ada.');
      }

      // Update data santri
      DB::table('data_santri')
        ->where('id', $id)
        ->update([
          'nama_lengkap' => $nama_lengkap,
          'no_identitas' => $no_identitas,
          'alamat' => $alamat,
          'tgl_lahir' => $tgl_lahir,
          'jenis_kelamin' => $jenis_kelamin,
          'keterangan' => $keterangan,
          'id_grup_cabang' => $grup_cabang,
          'id_grup_santri' => $grup_santri,
          'id_kelompok_quran' => $kelompok_quran,
          'status' => $status,
          'updated_at' => now(),
        ]);

      // Update atau Insert data wali ayah
      DB::table('data_walisantri')
        ->updateOrInsert(
          ['id_santri' => $id, 'hubungan' => 'Ayah'], // Kondisi
          [
            'nama_wali' => $nama_wali_ayah,
            'telepon' => $telepon_wali_ayah,
            'alamat' => $alamat_wali_ayah,
            'updated_at' => now(),
          ]
        );

      // Update atau Insert data wali ibu
      DB::table('data_walisantri')
        ->updateOrInsert(
          ['id_santri' => $id, 'hubungan' => 'Ibu'], // Kondisi
          [
            'nama_wali' => $nama_wali_ibu,
            'telepon' => $telepon_wali_ibu,
            'alamat' => $alamat_wali_ibu,
            'updated_at' => now(),
          ]
        );

      DB::commit(); // Commit transaksi jika berhasil

      return redirect()->route('admin.detail-santri', ['id' => $id])
        ->with('success', 'Data santri berhasil diperbarui.');
    } catch (\Exception $e) {
      DB::rollBack(); // Rollback transaksi jika terjadi error

      return redirect()->route('admin.kelola-santri')
        ->with('error', 'Gagal memperbarui data santri: ' . $e->getMessage());
    }
  }
}
