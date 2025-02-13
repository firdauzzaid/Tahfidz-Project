<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Tambahkan data ke tabel users
    $userId = DB::table('users')->insertGetId([
      'username' => 'masmutdev',
      'nama_lengkap' => 'Masmut Dev',
      'email' => 'masmutofficial@gmail.com',
      'password' => Hash::make('123321'),
      'level' => 0, // Admin
      'status' => 1, // Aktif
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    // Gunakan id yang baru saja ditambahkan ke tabel users
    DB::table('data_guru')->insert([
      'id_users' => $userId, // Ambil id dari tabel users
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }
}
