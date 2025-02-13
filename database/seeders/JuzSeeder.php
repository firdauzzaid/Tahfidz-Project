<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JuzSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // 1. Insert data into the 'juz' table
    $juzIds = [];
    $timestamps = [
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ];

    $juzIds[] = DB::table('juz')->insertGetId(array_merge([
      'nama_juz' => 'Juz 29'
    ], $timestamps));

    $juzIds[] = DB::table('juz')->insertGetId(array_merge([
      'nama_juz' => 'Juz 30'
    ], $timestamps));

    // 2. Insert levels into 'juz_level' table for each Juz
    $levelData = ['1', '3 / 4', '1 / 2', '1 / 4']; // Levels
    $juzLevelIds = [];

    foreach ($juzIds as $juzId) {
      foreach ($levelData as $level) {
        $juzLevelIds[] = DB::table('juz_level')->insertGetId(array_merge([
          'id_juz' => $juzId,
          'level' => $level
        ], $timestamps));
      }
    }

    // 3. Insert surah into 'juz_surat' table for each level
    // $surahData = [
    //     ['Al-Mulk', 'Al-Qalam', 'Al-Haqqah'],    // Example surahs for Level 1
    //     ['Al-Ma’arij', 'Nuh', 'Al-Jinn'],       // Example surahs for Level 3/4
    //     ['Al-Muzzammil', 'Al-Muddathir', 'Al-Qiyamah'], // Example surahs for Level 1/2
    //     ['Al-Insan', 'Al-Mursalat', 'An-Naba']  // Example surahs for Level 1/4
    // ];

    // foreach ($juzLevelIds as $index => $juzLevelId) {
    //     foreach ($surahData[$index % 4] as $surah) {
    //         DB::table('juz_surat')->insert(array_merge([
    //             'id_juz_level' => $juzLevelId,
    //             'nama_surat' => $surah
    //         ], $timestamps));
    //     }
    // }
  }
}
