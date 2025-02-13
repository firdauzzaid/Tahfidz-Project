<?php

namespace App\Http\Controllers\guru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaAbsen extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
    
        // Ambil data absen dengan join ke tabel users dan data_santri
        $data = DB::table('absen')
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
            )
            ->get();
    
        $grupSantri = DB::table('grup_santri')->select('id', 'nama_grup')->get();
        $dataSantri = DB::table('data_santri')->select('id', 'nama_lengkap')->get();
    
        return view('guru.kelola-absen', compact('data', 'grupSantri', 'dataSantri'));
    }


    public function simpanAbsensi(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|array', // Status harus berupa array
            'status.*' => 'required|in:0,1,2', // Setiap nilai dalam status array harus valid
            'tanggal_absensi' => 'nullable|date', // Tanggal boleh kosong
        ]);
    
        $userId = Auth::user()->id;
        $tanggalAbsensi = $validated['tanggal_absensi'] ?? now()->toDateString(); // Gunakan tanggal sekarang jika kosong
    
        try {
            foreach ($validated['status'] as $idSantri => $status) {
                // Periksa apakah absensi sudah ada untuk santri dan tanggal tertentu
                $existingAbsensi = DB::table('absen')
                    ->where('id_santri', $idSantri)
                    ->where('id_guru', $userId)
                    ->where('tanggal_absensi', $tanggalAbsensi)
                    ->first();
    
                if ($existingAbsensi) {
                    // Jika absensi sudah ada, perbarui data
                    DB::table('absen')
                        ->where('id', $existingAbsensi->id)
                        ->update([
                            'status' => $status,
                            'updated_at' => now(),
                        ]);
                } else {
                    // Jika absensi belum ada, tambahkan data baru
                    DB::table('absen')->insert([
                        'id_santri' => $idSantri,
                        'id_guru' => $userId,
                        'status' => $status,
                        'tanggal_absensi' => $tanggalAbsensi,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
            return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan absensi: ' . $e->getMessage());
        }
    }



    public function editAbsensi(Request $request, $id)
    {
        $validated = $request->validate([
            'id_santri' => 'required|exists:data_santri,id',
            'status' => 'required|in:0,1,2',
            'tanggal_absensi' => 'required|date', // Validasi tanggal
        ]);
    
        $userId = Auth::user()->id;
    
        try {
            DB::table('absen')
                ->where('id', $id)
                ->update([
                    'id_santri' => $validated['id_santri'],
                    'id_guru' => $userId,
                    'status' => $validated['status'],
                    'tanggal_absensi' => $validated['tanggal_absensi'], // Update tanggal
                    'updated_at' => now(),
                ]);
    
            return redirect()->back()->with('success', 'Absensi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui absensi.');
        }
    }

    public function deleteAbsensi($id)
    {
        try {
            DB::table('absen')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Absensi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus absensi.');
        }
    }
}
