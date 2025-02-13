<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('username', 255)->nullable();
      $table->string('nama_lengkap', 255);
      $table->string('email', 255)->unique();
      $table->string('password', 255);
      $table->integer('level')->default(1)->comment('0 = Admin, 1 = Guru, 2 = Wali Santri');
      $table->integer('status')->default(1)->comment('0 = Tidak Aktif, 1 = Aktif');
      $table->timestamps();
    });

    Schema::create('grup_cabang', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nama_grup', 255);
      $table->text('alamat_grup')->nullable();
      $table->timestamps();
    });

    Schema::create('grup_santri', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nama_grup', 255);
      $table->integer('jumlah_maksimal');
      $table->timestamps();
    });

    Schema::create('juz', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nama_juz', 255);
      $table->timestamps();
    });

    Schema::create('juz_level', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('id_juz')->nullable();
      $table->string('level', 255);
      $table->timestamps();

      $table->foreign('id_juz')->references('id')->on('juz')->onDelete('set null')->onUpdate('set null');
    });

    Schema::create('juz_surat', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('id_juz_level')->nullable();
      $table->string('nama_surat', 255);
      $table->timestamps();

      $table->foreign('id_juz_level')->references('id')->on('juz_level')->onDelete('set null')->onUpdate('set null');
    });

    Schema::create('data_guru', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('id_grup_cabang')->nullable();
      $table->unsignedBigInteger('id_grup_santri')->nullable();
      $table->unsignedBigInteger('id_users');
      $table->string('lulusan', 255)->nullable();
      $table->text('foto')->nullable();
      $table->text('riwayat_mengajar')->nullable();
      $table->timestamps();

      $table->foreign('id_grup_cabang')->references('id')->on('grup_cabang')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('id_grup_santri')->references('id')->on('grup_santri')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    });

    Schema::create('data_santri', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('id_grup_cabang');
      $table->unsignedBigInteger('id_grup_santri');
      $table->bigInteger('no_identitas');
      $table->string('nama_lengkap', 255);
      $table->string('alamat', 255);
      $table->string('tgl_lahir', 255);
      $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
      $table->text('keterangan')->nullable();
      $table->string('link_sertifikat', 255)->nullable();
      $table->integer('status')->default(0)->comment('0 = Aktif, 1 = Lulus');
      $table->timestamps();

      $table->foreign('id_grup_cabang')->references('id')->on('grup_cabang')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('id_grup_santri')->references('id')->on('grup_santri')->onDelete('cascade')->onUpdate('cascade');
    });

    Schema::create('data_walisantri', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('id_santri');
      $table->bigInteger('no_identitas')->nullable();
      $table->bigInteger('telepon')->nullable();
      $table->text('alamat')->nullable();
      $table->string('hubungan', 255);
      $table->timestamps();

      $table->foreign('id_santri')->references('id')->on('data_santri')->onDelete('cascade')->onUpdate('cascade');
    });

    Schema::create('jadwal', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->timestamps();

      $table->foreign('id_guru')->references('id')->on('data_guru')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('id_santri')->references('id')->on('data_santri')->onDelete('cascade')->onUpdate('cascade');
    });

    Schema::create('absen', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->integer('status')->default(0)->comment('0 = Belum Absen, 1 = Sudah Absen, 2 = Izin');
      $table->text('keterangan')->nullable();
      $table->date('tanggal_absensi')->nullable();
      $table->timestamps();

      $table->foreign('id_guru')->references('id')->on('data_guru')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('id_santri')->references('id')->on('data_santri')->onDelete('cascade')->onUpdate('cascade');
    });

    // Tabel nilai_mtahsin
    Schema::create('nilai_mtahsin', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->string('jilid');
      $table->string('level');
      $table->integer('nilai');
      $table->timestamps();
    });

    // Tabel nilai_mtahfidz
    Schema::create('nilai_mtahfidz', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->date('tanggal');
      $table->string('juz');
      $table->unsignedBigInteger('id_juz');
      $table->unsignedBigInteger('id_juz_level');
      $table->integer('pengetahuan');
      $table->integer('fashohah');
      $table->integer('tajwid');
      $table->timestamps();
    });

    // Tabel nilai_ptahsin
    Schema::create('nilai_ptahsin', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->date('tanggal');
      $table->string('jilid');
      $table->integer('halaman');
      $table->text('keterangan')->nullable();
      $table->timestamps();
    });

    // Tabel nilai_ptahfidz
    Schema::create('nilai_ptahfidz', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->date('tanggal');
      $table->unsignedBigInteger('id_juz');
      $table->unsignedBigInteger('id_surah');
      $table->string('ayat');
      $table->text('keterangan')->nullable();
      $table->timestamps();
    });

    // Tabel nilai_murojaah
    Schema::create('nilai_murojaah', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->date('tanggal');
      $table->time('waktu');
      $table->string('juz');
      $table->string('nama_surah');
      $table->text('keterangan')->nullable();
      $table->timestamps();
    });

    // Tabel nilai_tasmi
    Schema::create('nilai_tasmi', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('id_guru');
      $table->unsignedBigInteger('id_santri');
      $table->string('juz');
      $table->integer('tajwid1');
      $table->integer('tajwid2');
      $table->integer('tajwid3');
      $table->integer('tajwid4');
      $table->integer('fashohah1');
      $table->integer('fashohah2');
      $table->integer('fashohah3');
      $table->integer('fashohah4');
      $table->integer('status')->default(0)->comment('0 = Aktif, 1 = Lulus');
      $table->timestamps();
    });

    Schema::create('settings_web', function (Blueprint $table) {
      $table->id();
      $table->string('nama_website');
      $table->text('deskripsi_website');
      $table->text('keyword_website');
      $table->text('logo_website');
      $table->string('email_website', 255);
      $table->string('telpon_website', 255);
      $table->integer('status')->default(1)->comment('0 = Maintenance, 1 = Aktif');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('settings_web');
    Schema::dropIfExists('raport_santri');
    Schema::dropIfExists('data_raport_tahfidz');
    Schema::dropIfExists('data_raport_tahsin');
    Schema::dropIfExists('nilai_mtahsin');
    Schema::dropIfExists('nilai_mtahfidz');
    Schema::dropIfExists('nilai_ptahsin');
    Schema::dropIfExists('nilai_ptahfidz');
    Schema::dropIfExists('nilai_murojaah');
    Schema::dropIfExists('nilai_tasmi');
    Schema::dropIfExists('jadwal');
    Schema::dropIfExists('absen');
    Schema::dropIfExists('data_walisantri');
    Schema::dropIfExists('data_santri');
    Schema::dropIfExists('data_guru');
    Schema::dropIfExists('juz_surat');
    Schema::dropIfExists('juz_level');
    Schema::dropIfExists('juz');
    Schema::dropIfExists('grup_santri');
    Schema::dropIfExists('grup_cabang');
    Schema::dropIfExists('users');
  }
};
