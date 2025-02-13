<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KelolaGuru extends Controller
{
    /**
        * Redirect to user-management view.
        *
    */
    public function KelolaGuru()
    {
        // Ambil data dari tabel grup_cabang
        $grupCabang = DB::table('grup_cabang')
            ->select('id', 'nama_grup', 'alamat_grup')
            ->get();

        // Kirim data ke view
        return view('admin.kelola-guru', ['grupCabang' => $grupCabang]);
        // return view('admin.kelola-guru');
    }
        
    // Ambil grup_santri berdasarkan id_cabang yang dipilih
    // public function getDataRombel($id_cabang)
    // {
    //     // Ambil grup_santri berdasarkan id_cabang yang dipilih
    //     $grupSantriCabang = DB::table('grup_santri')
    //         ->where('id_cabang', $id_cabang)
    //         ->get();

    //     return response()->json([
    //         'success' => count($grupSantriCabang) > 0,
    //         'rombel_data' => $grupSantriCabang
    //     ]);
    // }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $columns = [
          1 => 'id',
          2 => 'username',
          3 => 'nama_lengkap',
          4 => 'email',
          5 => 'level',
          6 => 'status',
          7 => 'created_at'
      ];

      // Hitung total data dengan level selain 2
      $totalData = DB::table('users')->where('level', '!=', 2)->count();

      $totalFiltered = $totalData;

      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');

      if (empty($request->input('search.value'))) {
          $users = DB::table('users')
              ->where('level', '!=', 2) // Tambahkan filter level
              ->offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
      } else {
          $search = $request->input('search.value');

          $users = DB::table('users')
              ->where('level', '!=', 2) // Tambahkan filter level
              ->where(function ($query) use ($search) {
                  $query->where('id', 'LIKE', "%{$search}%")
                      ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
              })
              ->offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();

          $totalFiltered = DB::table('users')
              ->where('level', '!=', 2) // Tambahkan filter level
              ->where(function ($query) use ($search) {
                  $query->where('id', 'LIKE', "%{$search}%")
                      ->orWhere('nama_lengkap', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
              })
              ->count();
      }

      $data = [];

      if (!empty($users)) {
          $ids = $start;

          foreach ($users as $user) {
              $nestedData['id'] = $user->id;
              $nestedData['fake_id'] = ++$ids;
              $nestedData['username'] = $user->username;
              $nestedData['nama_lengkap'] = $user->nama_lengkap;
              $nestedData['email'] = $user->email;
              $nestedData['level'] = $user->level;
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

      if ($userID) {
          // Cek apakah email sudah digunakan oleh pengguna lain
          $emailExists = DB::table('users')
              ->where('email', $request->email)
              ->where('id', '!=', $userID) // Pastikan bukan email milik pengguna yang sedang diperbarui
              ->exists();

          if ($emailExists) {
              return response()->json(['message' => 'Email sudah digunakan', 'status' => 'email_exists'], 422);
          }

          $dataToUpdate = [
              'nama_lengkap' => $request->nama_lengkap,
              'username' => $request->username,
              'email' => $request->email,
              'level' => $request->level,
              'status' => $request->status,
              'updated_at' => now(),
          ];

          if (!empty($request->password)) {
              $dataToUpdate['password'] = bcrypt($request->password);
          }

          $updated = DB::table('users')
              ->where('id', $userID)
              ->update($dataToUpdate);

          if ($updated) {
              return response()->json(['message' => 'Berhasil Mengupdate Guru', 'status' => 'updated']);
          } else {
              return response()->json(['message' => 'Gagal Mengupdate Guru', 'status' => 'update_failed'], 500);
          }
      } else {
          $userEmail = DB::table('users')
              ->where('email', $request->email)
              ->exists();

          if ($userEmail) {
              return response()->json(['message' => 'Sudah Ada Email Guru Yang Sama', 'status' => 'duplicate'], 422);
          }

          // Masukkan data ke tabel users dan dapatkan ID yang baru dibuat
          $userId = DB::table('users')->insertGetId([
              'nama_lengkap' => $request->nama_lengkap,
              'username' => $request->username,
              'email' => $request->email,
              'password' => bcrypt($request->password),
              'level' => $request->level,
              'status' => $request->status,
              'created_at' => now(),
              'updated_at' => now(),
          ]);

          // Jika berhasil, tambahkan data ke tabel data_guru atau admin
        if ($userId) {
            if ($request->level == 0) {
                return response()->json(['message' => 'Berhasil Menambahkan Admin', 'status' => 'created']);
            } else {
                $createdGuru = DB::table('data_guru')->insert([
                    'id_users' => $userId,
                    'id_grup_cabang' => $request->grup_cabang ?? null,
                    'id_grup_santri' => $request->grup_santri ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($createdGuru) {
                    return response()->json(['message' => 'Berhasil Menambahkan Guru', 'status' => 'created']);
                } else {
                    return response()->json(['message' => 'Gagal Membuat Data Guru', 'status' => 'create_failed_guru'], 500);
                }
            }
        } else {
            return response()->json(['message' => 'Gagal Menambahkan Data', 'status' => 'create_failed'], 500);
        }
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
    $user = DB::table('users')->where('id', $id)->first();

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
    $deleted = DB::table('users')->where('id', $id)->delete();

    if ($deleted) {
      return response()->json(['message' => 'User deleted successfully'], 200);
    } else {
      return response()->json(['message' => 'User not found or deletion failed'], 404);
    }
  }

  public function selectPengguna()
  {
    // Ambil semua data id dan hp dari tabel users
    $users = DB::table('data_guru')->select('id', 'nama_lengkap_lengkap', 'email')->get();

    // Kembalikan data dalam bentuk JSON
    return response()->json($users);
  }

  public function detailGuru($id)
  {
      // Ambil data dari tabel users berdasarkan id
      $guru = DB::table('users')
          ->where('id', $id)
          ->first();

      // Jika data user ditemukan
      if ($guru) {
          // Ambil data tambahan dari data_guru
          $dataGuru = DB::table('data_guru')
              ->where('id_users', $id)
              ->first();

          // Inisialisasi variabel detailGuru
          $detailGuru = [
              'id' => $guru->id,
              'username' => $guru->username,
              'email' => $guru->email,
              'nama_lengkap' => $guru->nama_lengkap,
              'level' => $guru->level,
              'status' => $guru->status,
              'created_at' => $guru->created_at,
              'updated_at' => $guru->updated_at,
              'id_grup_cabang' => $dataGuru->id_grup_cabang ?? null,
              'id_grup_santri' => $dataGuru->id_grup_santri ?? null,
              'lulusan' => $dataGuru->lulusan ?? null,
              'foto' => $dataGuru->foto ?? null,
              'riwayat_mengajar' => $dataGuru->riwayat_mengajar ?? null,
          ];

          // Ambil data grup_cabang berdasarkan id_grup_cabang
          if (!empty($dataGuru->id_grup_cabang)) {
              $grupCabang = DB::table('grup_cabang')
                  ->select('id', 'nama_grup', 'alamat_grup')
                  ->where('id', $dataGuru->id_grup_cabang)
                  ->first();

              $detailGuru['grup_cabang'] = $grupCabang;
          }
          // Ambil semua data dari tabel grup_cabang
              $grupCabang = DB::table('grup_cabang')
                  ->select('id', 'nama_grup', 'alamat_grup')
                  ->get();
          

          // Ambil data grup_santri berdasarkan id_grup_cabang
          if (!empty($dataGuru->id_grup_santri)) {
              $grupSantri = DB::table('grup_santri')
                  ->select('id', 'id_cabang', 'nama_grup', 'jumlah_maksimal')
                  ->where('id_cabang', $dataGuru->id_grup_cabang)
                  ->first();

              $detailGuru['grup_santri'] = $grupSantri;
          }
          // Ambil semua data dari tabel grup_santri
               $grupSantri = DB::table('grup_santri')
                  ->select('id', 'id_cabang', 'nama_grup', 'jumlah_maksimal')
                  ->get();

          // Tampilkan data ke view
          return view('admin.detail-guru', compact('detailGuru','grupCabang', 'grupSantri'));
      } else {
          // Jika data user tidak ditemukan, redirect dengan pesan error
          return redirect()->route('admin.kelola-guru')->with('error', 'Guru tidak ditemukan.');
      }
  }

  public function editDataGuru(Request $request)
  {
    // Validasi data
    $request->validate([
      'id' => 'required|integer',
      'username' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'level' => 'required|integer|in:0,1',
      'status' => 'required|integer|in:0,1',
      'lulusan' => 'required|string|max:255',
      'riwayat_mengajar' => 'required|string|max:255',
      'foto' => 'nullable|file|mimes:jpg,png,webp,heic,jpeg|max:5120', // Maks 5MB
      'grup_cabang' => 'required|exists:grup_cabang,id',
      'grup_santri' => 'required|exists:grup_santri,id'
    ]);

    // Data dari request
    $id = $request->input('id');
    $username = $request->input('username');
    $email = $request->input('email');
    $level = $request->input('level');
    $status = $request->input('status');
    $lulusan = $request->input('lulusan');
    $riwayatMengajar = $request->input('riwayat_mengajar');
    $idGrupCabang = $request->input('grup_cabang');
    $idGrupSantri = $request->input('grup_santri');

    // Proses file foto jika ada
    $fotoNama = null;
    if ($request->hasFile('foto')) {
      $foto = $request->file('foto');

      // Simpan hanya nama file
      $fotoNama = time() . '_' . $foto->getClientOriginalName();
      $foto->storeAs('public/foto-guru', $fotoNama);
    }

    try {
      // Update data pada tabel users
      DB::table('users')->where('id', $id)->update([
        'username' => $username,
        'email' => $email,
        'level' => $level,
        'status' => $status,
        'updated_at' => now(),
      ]);

      // Update data pada tabel data_guru
      $dataGuruUpdate = [
        'lulusan' => $lulusan,
        'riwayat_mengajar' => $riwayatMengajar,
        'id_grup_cabang' => $idGrupCabang,
        'id_grup_santri' => $idGrupSantri
      ];

      if ($fotoNama) {
        $dataGuruUpdate['foto'] = $fotoNama;
      }

      DB::table('data_guru')->where('id_users', $id)->update($dataGuruUpdate);

      return redirect()->back()->with('success', 'Data guru berhasil diperbarui!');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }
}
