<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landing\Home;
use App\Http\Controllers\admin\Laporan;
use App\Http\Controllers\auth\LoginArea;
use App\Http\Controllers\admin\KelolaJuz;
use App\Http\Controllers\admin\KelolaGuru;
use App\Http\Controllers\admin\SettingWeb;
use App\Http\Controllers\guru\KelolaAbsen;
use App\Http\Controllers\guru\KelolaNilai;
use App\Http\Controllers\guru\MasterNilai;
use App\Http\Controllers\admin\KelolaUsers;
use App\Http\Controllers\auth\RegisterArea;
use App\Http\Controllers\admin\KelolaJadwal;
use App\Http\Controllers\admin\KelolaSantri;
use App\Http\Controllers\guru\DashboardGuru;
use App\Http\Controllers\guru\KelolaMurojaah;
use App\Http\Controllers\guru\CetakData;
use App\Http\Controllers\admin\DashboardAdmin;
use App\Http\Controllers\guru\KelolaDataRaport;
use App\Http\Controllers\admin\KelolaGrupCabang;
use App\Http\Controllers\admin\KelolaGrupSantri;
use App\Http\Controllers\admin\KelolaGrupKelompok;
use App\Http\Controllers\wali\DashboardWali;

// AUTH
Route::get('/auth/login', [LoginArea::class, 'index'])->name('auth-login')->middleware('auth');
Route::get('/', [LoginArea::class, 'index'])->name('auth-login-awal')->middleware('auth');

Route::get('/unauthorized', [LoginArea::class, 'unauthorized'])->name('unauthorized')->middleware('auth');
Route::post('/cek-login', [LoginArea::class, 'cekLogin'])->name('cek-login');
Route::post('/logout', [LoginArea::class, 'logout'])->name('logout');

Route::get('/sertifikat/{id_santri}', [Home::class, 'sertifikat'])->name('sertifikat');

//ADMIN
Route::middleware(['auth-admin'])->group(function () {
  //--Dashboard
  Route::get('/dashboard-admin', [DashboardAdmin::class, 'index'])->name('admin.dashboard-admin');

  //--Kelola Guru
  Route::get('/kelola-guru', [KelolaGuru::class, 'KelolaGuru'])->name('admin.kelola-guru');
  // Route::get('/update-rombel-data/{id_cabang}', [KelolaGuru::class, 'getDataRombel'])->name('updateRombelData');
  Route::get('/admin/select-guru', [KelolaGuru::class, 'selectPengguna']);
  Route::get('/admin/detail-guru/{id}', [KelolaGuru::class, 'detailGuru'])->name('admin.detail-guru');
  Route::post('/admin/edit-data-guru', [KelolaGuru::class, 'editDataGuru'])->name('admin.edit-data-guru');
  Route::resource('/guru-list', KelolaGuru::class);

  //--Kelola Santri
  Route::get('/kelola-santri', [KelolaSantri::class, 'KelolaSantri'])->name('admin.kelola-santri');
  Route::get('/update-rombel-data/{id_cabang}', [KelolaSantri::class, 'getDataRombel'])->name('updateRombelData');
  Route::get('/update-kelompok-quran-data/{id_rombel}', [KelolaSantri::class, 'getDataKelompokQuran'])->name('updateKelompokQuranData');
  Route::get('/admin/select-santri', [KelolaSantri::class, 'selectPengguna']);
  Route::get('/admin/detail-santri/{id}', [KelolaSantri::class, 'detailSantri'])->name('admin.detail-santri');
  Route::post('/admin/edit-data-santri/{id}', [KelolaSantri::class, 'editDataSantri'])->name('admin.edit-data-santri');
  Route::resource('/santri-list', KelolaSantri::class);

  //-Kelola Jadwal
  Route::get('/kelola-jadwal', [KelolaJadwal::class, 'index'])->name('admin.kelola-jadwal');
  //-Kelola Grup Cabang
  Route::get('/kelola-grup-cabang', [KelolaGrupCabang::class, 'index'])->name('admin.kelola-grup-cabang');
  Route::post('/admin/tambah-grup-cabang', [KelolaGrupCabang::class, 'tambahGrupCabang'])->name('admin.tambah-grup-cabang');
  Route::post('/admin/edit-grup-cabang/{id}', [KelolaGrupCabang::class, 'editGrupCabang'])->name('admin.edit-grup-cabang');
  Route::post('/admin/delete-grup-cabang/{id}', [KelolaGrupCabang::class, 'deleteGrupCabang'])->name('admin.hapus-grup-cabang');

  //-Kelola Grup Santri
  Route::get('/kelola-grup-santri', [KelolaGrupSantri::class, 'index'])->name('admin.kelola-grup-santri');
  Route::post('/admin/tambah-grup-santri', [KelolaGrupSantri::class, 'tambahGrupSantri'])->name('admin.tambah-grup-santri');
  Route::post('/admin/edit-grup-santri/{id}', [KelolaGrupSantri::class, 'editGrupSantri'])->name('admin.edit-grup-santri');
  Route::post('/admin/delete-grup-santri/{id}', [KelolaGrupSantri::class, 'deleteGrupSantri'])->name('admin.hapus-grup-santri');

  //-Kelola Grup Kelompok
  Route::get('/kelola-grup-kelompok', [KelolaGrupKelompok::class, 'index'])->name('admin.kelola-grup-kelompok');
  Route::post('/admin/tambah-grup-kelompok', [KelolaGrupKelompok::class, 'tambahGrupKelompok'])->name('admin.tambah-grup-kelompok');
  Route::post('/admin/edit-grup-kelompok/{id}', [KelolaGrupKelompok::class, 'editGrupKelompok'])->name('admin.edit-grup-kelompok');
  Route::post('/admin/delete-grup-kelompok/{id}', [KelolaGrupKelompok::class, 'deleteGrupKelompok'])->name('admin.hapus-grup-kelompok');

  //-Kelola Juz
  Route::get('/kelola-juz', [KelolaJuz::class, 'index'])->name('admin.kelola-juz');
  Route::post('/admin/tambah-juz', [KelolaJuz::class, 'tambahJuz'])->name('admin.tambah-juz');
  Route::post('/admin/edit-juz/{id}', [KelolaJuz::class, 'editJuz'])->name('admin.edit-juz');
  Route::post('/admin/hapus-juz/{id}', [KelolaJuz::class, 'hapusJuz'])->name('admin.hapus-juz');
  Route::post('/admin/tambah-juz-level', [KelolaJuz::class, 'tambahLevel'])->name('admin.tambah-juz-level');
  Route::post('/admin/edit-juz-level/{id_juz}', [KelolaJuz::class, 'editLevel'])->name('admin.edit-juz-level');
  Route::post('/admin/hapus-juz-level/{id_juz}', [KelolaJuz::class, 'hapusLevel'])->name('admin.hapus-juz-level');
  Route::post('/admin/tambah-juz-surat', [KelolaJuz::class, 'tambahSurat'])->name('admin.tambah-surat');
  Route::post('/admin/edit-surat/{id_juz_level}', [KelolaJuz::class, 'editSurat'])->name('admin.edit-surat');
  Route::post('/admin/hapus-surat/{id_juz_level}', [KelolaJuz::class, 'hapusSurat'])->name('admin.hapus-surat');
  Route::get('/admin/get-levels/{id_juz}', [KelolaJuz::class, 'getLevels'])->name('admin.getLevels');

  //-Laporan
  Route::get('/laporan', [Laporan::class, 'index'])->name('admin.laporan');

  //-Pengaturan Website
  Route::get('/pengaturan-website', [SettingWeb::class, 'index'])->name('admin.pengaturan-website');
  Route::post('/update-website', [SettingWeb::class, 'updateWebsite'])->name('admin.update-website');

  //--My Profile
  Route::post('/admin/my-profile', [DashboardAdmin::class, 'myProfile'])->name('admin.my-profile');
});

//GURU
Route::middleware(['auth-guru'])->group(function () {
  //--Dashboard
  Route::get('/dashboard-guru', [DashboardGuru::class, 'index'])->name('guru.dashboard-guru');

  //--Kelola Absen
  Route::get('/kelola-absen', [KelolaAbsen::class, 'index'])->name('guru.kelola-absen');
  Route::post('/simpan-absensi', [KelolaAbsen::class, 'simpanAbsensi'])->name('guru.kelola-absen');
  Route::post('/edit-absensi/{id}', [KelolaAbsen::class, 'editAbsensi'])->name('guru.edit-absensi');
  Route::post('/hapus-absensi/{id}', [KelolaAbsen::class, 'deleteAbsensi'])->name('guru.delete-absensi');

  //--Master Nilai
  Route::get('/master-nilai', [MasterNilai::class, 'index'])->name('guru.master-nilai');

  //--Kelola Data Raport
  Route::get('/perkembangan-tahsin', [KelolaDataRaport::class, 'perkembanganTahsin'])->name('guru.perkembanganTahsin');
  Route::post('/simpan-perkembangan-tahsin', [KelolaDataRaport::class, 'simpanPTahsin'])->name('guru.simpanPTahsin');
  Route::post('/simpan-data-lanjutan-ptahsin', [KelolaDataRaport::class, 'simpanDataLanjutanPTahsin'])->name('guru.simpanDataLanjutanPTahsin');
  Route::get('/tambah-data-awal-ptahsin', [KelolaDataRaport::class, 'tambahDataAwalPTahsin'])->name('guru.tambahDataAwalPTahsin');
  Route::post('/edit-perkembangan-tahsin/{id}', [KelolaDataRaport::class, 'editPTahsin'])->name('guru.editPTahsin');
  Route::post('/hapus-perkembangan-tahsin/{id}', [KelolaDataRaport::class, 'hapusPTahsin'])->name('guru.hapusPTahsin');

  Route::get('/perkembangan-tahfidz', [KelolaDataRaport::class, 'perkembanganTahfidz'])->name('guru.perkembanganTahfidz');
  Route::post('/simpan-perkembangan-tahfidz', [KelolaDataRaport::class, 'simpanPTahfidz'])->name('guru.simpanPTahfidz');
  Route::post('/simpan-data-lanjutan-ptahfidz', [KelolaDataRaport::class, 'simpanDataLanjutanPTahfidz'])->name('guru.simpanDataLanjutanPTahfidz');
  Route::get('/tambah-data-awal-ptahfidz', [KelolaDataRaport::class, 'tambahDataAwalPTahfidz'])->name('guru.tambahDataAwalPTahfidz');
  Route::post('/edit-perkembangan-tahfidz/{id}', [KelolaDataRaport::class, 'editPTahfidz'])->name('guru.editPTahfidz');
  Route::post('/hapus-perkembangan-tahfidz/{id}', [KelolaDataRaport::class, 'hapusPTahfidz'])->name('guru.hapusPTahfidz');

  Route::get('/munaqasyah-tahsin', [KelolaDataRaport::class, 'munaqasyahTahsin'])->name('guru.munaqasyahTahsin');
  Route::post('/simpan-munaqasyah-tahsin', [KelolaDataRaport::class, 'simpanMTahsin'])->name('guru.simpanMTahsin');
  Route::post('/hapus-munaqasyah-tahsin/{id}', [KelolaDataRaport::class, 'hapusMTahsin'])->name('guru.hapusMTahsin');

  Route::get('/munaqasyah-tahfidz', [KelolaDataRaport::class, 'munaqasyahTahfidz'])->name('guru.munaqasyahTahfidz');
  Route::post('/simpan-munaqasyah-tahfidz', [KelolaDataRaport::class, 'simpanMTahfidz'])->name('guru.simpanMTahfidz');
  Route::post('/simpan-data-lanjutan-mtahfidz', [KelolaDataRaport::class, 'simpanDataLanjutanMTahfidz'])->name('guru.simpanDataLanjutanMTahfidz');
  Route::get('/tambah-data-awal', [KelolaDataRaport::class, 'tambahDataAwal'])->name('guru.tambahDataAwal');
  Route::post('/hapus-munaqasyah-tahfidz/{id}', [KelolaDataRaport::class, 'hapusMTahfidz'])->name('guru.hapusMTahfidz');

  Route::get('/murojaah', [KelolaDataRaport::class, 'murojaah'])->name('guru.murojaah');
  Route::post('/simpan-murojaah', [KelolaDataRaport::class, 'simpanMurojaah'])->name('guru.simpanMurojaah');
  Route::post('/hapus-murojaah/{id}', [KelolaDataRaport::class, 'hapusMurojaah'])->name('guru.hapusMurojaah');

  Route::get('/tasmi', [KelolaDataRaport::class, 'tasmi'])->name('guru.tasmi');
  Route::post('/simpan-tasmi', [KelolaDataRaport::class, 'simpanTasmi'])->name('guru.simpanTasmi');
  Route::post('/hapus-tasmi/{id}', [KelolaDataRaport::class, 'hapusTasmi'])->name('guru.hapusTasmi');

  Route::get('/kelola-data-raport', [KelolaDataRaport::class, 'index'])->name('guru.kelola-data-raport');
  
  Route::get('/get-data-grup-cabang', [KelolaDataRaport::class, 'getGrupCabang'])->name('getGrupCabang');
  Route::get('/get-data-grup-santri/{id_cabang}', [KelolaDataRaport::class, 'getGrupSantri'])->name('getGrupSantri');
  Route::get('/get-data-grup-kelompok/{id_rombel}', [KelolaDataRaport::class, 'getGrupKelompok'])->name('getGrupKelompok');
  
  Route::get('/get-data-juz', [KelolaDataRaport::class, 'getDataJuz'])->name('getDataJuz');
  Route::get('/get-data-level/{id_juz}', [KelolaDataRaport::class, 'getDataLevel'])->name('getDataLevel');
  Route::get('/get-data-surah/{id_juz_level}', [KelolaDataRaport::class, 'getDataSurah'])->name('getDataSurah');

  Route::get('/get-data-santri-by-grup/{id_grup_kelompok}', [KelolaDataRaport::class, 'getDataSantriByGrup'])->name('getDataSantriByGrup');

  Route::get('/update-surah-data', [KelolaDataRaport::class, 'updateSurahData'])->name('updateSurahData');
  Route::get('/update-santri-data', [KelolaDataRaport::class, 'updateSantriData'])->name('updateSantriData');

  //--Kelola Murojaah
  //--Kelola Nilai
  Route::get('/kelola-nilai', [KelolaNilai::class, 'index'])->name('guru.kelola-nilai');
  
  // --Cetak Data
  Route::get('/cetak-data-absensi', [CetakData::class, 'cetakAbsensi'])->name('cetak.absensi');
  Route::get('/cetak-data-perkembangan-tahsin', [CetakData::class, 'cetakPerkembanganTahsin'])->name('cetak.perkembangan-tahsin');
  Route::get('/cetak-data-perkembangan-tahfidz', [CetakData::class, 'cetakPerkembanganTahfidz'])->name('cetak.perkembangan-tahfidz');
  Route::get('/cetak-data-munaqasyah-tahsin', [CetakData::class, 'cetakMunaqasyahTahsin'])->name('cetak.munaqasyah-tahsin');
  Route::get('/cetak-data-munaqasyah-tahfidz', [CetakData::class, 'cetakMunaqasyahTahfidz'])->name('cetak.munaqasyah-tahfidz');

});

//WALI
Route::middleware(['auth-wali'])->group(function () {
  //--Dashboard
  Route::get('/dashboard-walisantri', [DashboardWali::class, 'index'])->name('wali.dashboard-wali');
  Route::get('/data-absensi', [DashboardWali::class, 'dataAbsensi'])->name('wali.data-absensi');
  Route::get('/data-nilai', [DashboardWali::class, 'dataNilai'])->name('wali.data-nilai');

});
