@php
    $customizerHidden = 'customizer-hide';
    // Variabel untuk mengecek apakah data sudah tersimpan
    $dataAwalSudahDiisi = isset($dataAwal) && $dataAwal !== null;
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Munaqasyah Tahfidz (Data Raport)')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/charts-apex.js'])
@endsection

@section('content')
    @include('partials.alerts')

    <div class="row">
        <!-- Form Munaqasyah Tahfidz (Data Raport) -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3>Munaqasyah Tahfidz (Data Raport)</h3>

                    <!-- Form Data Utama (Grup, Santri, Tanggal, Juz) -->
                    @if(!session('nilaiId'))
                        <form action="/simpan-munaqasyah-tahfidz" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="grupCabangTahfidz" class="form-label">Kelas</label>
                                <select class="form-select" id="grupCabangTahfidz" name="grup_cabang" required>
                                    <option selected>Pilih Kelas</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="grupSantriTahfidz" class="form-label">Rombel</label>
                                <select class="form-select" id="grupSantriTahfidz" name="grup_santri" required>
                                    <option selected>Pilih Rombel</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="grupKelompokTahfidz" class="form-label">Kelompok Qur'an</label>
                                <select class="form-select" id="grupKelompokTahfidz" name="grup_kelompok" required>
                                    <option selected>Pilih Kelompok Qur'an</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="dataSantriTahfidz" class="form-label">Data Santri</label>
                                <select class="form-select" id="dataSantriTahfidz" name="id_santri" required>
                                    <option selected>Pilih Data Santri</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="mb-3">
                                <label for="juz" class="form-label">Juz</label>
                                <select class="form-select" id="juz" name="juz">
                                    <option selected>Pilih Juz</option>
                                    <!-- Tambahkan options dari  -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="levelTahfidz" class="form-label">Level</label>
                                <select class="form-select" id="levelTahfidz" name="id_juz">
                                    <option selected>Pilih Level</option>
                                    <!-- Tambahkan options dari  -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="surah" class="form-label">Surah</label>
                                <select class="form-select" id="surah" name="id_juz_level">
                                    <option value="" disabled selected>Pilih Surah</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="pengetahuan" class="form-label">Pengetahuan</label>
                                <input type="number" class="form-control" id="pengetahuan" name="pengetahuan" required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah" class="form-label">Fashohah</label>
                                <input type="number" class="form-control" id="fashohah" name="fashohah" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid" class="form-label">Tajwid</label>
                                <input type="number" class="form-control" id="tajwid" name="tajwid" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <!-- Form Penilaian (Surah, Pengetahuan, Fashohah, Tajwid) -->
                        <form action="/simpan-data-lanjutan-mtahfidz" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="grupCabangTahfidz" class="form-label">Kelas</label>
                                <input type="text" class="form-select" id="grupCabangTahfidz" value="{{ session('namaGrupCabang')->nama_grup ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="grupSantriTahfidz" class="form-label">Rombel</label>
                                <input type="text" class="form-select" id="grupSantriTahfidz" value="{{ session('namaGrupSantri')->nama_grup ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="grupKelompokTahfidz" class="form-label">Kelompok Qur'an</label>
                                <input type="text" class="form-select" id="grupKelompokTahfidz" value="{{ session('namaGrupKelompok')->nama_kelompok ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="dataSantriTahfidz" class="form-label">Data Santri</label>
                                <input type="text" class="form-control" id="dataSantriTahfidz" value="{{ session('namaSantri')->nama_lengkap ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" value="{{ session('tanggal') }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="juz" class="form-label">Juz</label>
                                <input type="text" class="form-control" id="juz" value="{{ session('namaJuz')->nama_juz ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="levelTahfidzUpdate" class="form-label">Level</label>
                                <input type="text" class="form-control" id="levelTahfidzUpdate" value="{{ session('namaLevel')->level ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="surahUpdate" class="form-label">Surah</label>
                                <select class="form-select" id="surahUpdate" name="id_juz_level" required>
                                    <option disabled selected>Pilih Surah</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="pengetahuan" class="form-label">Pengetahuan</label>
                                <input type="number" class="form-control" id="pengetahuan" name="pengetahuan" required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah" class="form-label">Fashohah</label>
                                <input type="number" class="form-control" id="fashohah" name="fashohah" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid" class="form-label">Tajwid</label>
                                <input type="number" class="form-control" id="tajwid" name="tajwid" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="{{ route('guru.tambahDataAwalMTahfidz') }}" class="btn btn-secondary">Data Baru</a>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <div class="card">
                <h3 class="p-3 text-center">Daftar Siswa - Munaqasyah Tahfidz</h3>
                <div class="d-flex flex-row justify-content-center align-items-center mb-4">
                    <a href="/cetak-data-munaqasyah-tahfidz" class="btn btn-primary">Cetak Data Munaqasyah Tahfidz</a>
                </div>
                <div class="card-body mt-0 pt-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Santri</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Juz</th>
                                    <th class="text-center">Nama Surat</th>
                                    <th class="text-center">Pengetahuan</th>
                                    <th class="text-center">Fashohah</th>
                                    <th class="text-center">Tajwid</th>
                                    <th class="text-center">Dibuat Pada</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $item->nama_santri }}</td>
                                        <td class="text-center">{{ $item->nama_guru }}</td>
                                        <td class="text-center">{{ $item->tanggal }}</td>
                                        <td class="text-center">{{ $item->nama_juz }}</td>
                                        <td class="text-center">{{ $item->nama_surat }}</td>
                                        <td class="text-center">{{ $item->pengetahuan }}</td>
                                        <td class="text-center">{{ $item->fashohah }}</td>
                                        <td class="text-center">{{ $item->tajwid }}</td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex flex-row justify-content-center">
                                                <!-- Button Hapus -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusMurojaah{{ $item->id }}">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus Murojaah -->
                                    <div class="modal fade" id="modalHapusMurojaah{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" style="max-width: auto;">
                                            <form action="/hapus-munaqasyah-tahfidz/{{ $item->id }}" method="POST">
                                                @csrf
                                                <div class="modal-content" style="min-width: 200px;">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data ini? Data yang
                                                            dihapus tidak dapat dikembalikan.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ambil data Grup Cabang(Kelas)
            $.ajax({
                url: "{{ route('getGrupCabang') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Hapus opsi lama kecuali opsi pertama
                    $('#grupCabangTahfidz').find('option:not(:first)').remove();

                    // Tambahkan opsi baru
                    $.each(data, function(key, value) {
                        $('#grupCabangTahfidz').append(
                            `<option value="${value.id}">${value.nama_grup}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching grup santri:', error);
                }
            });

            // Ambil Data Grup Santri(Rombel) berdasarkan Grup Cabang(Kelas) yang dipilih
            $('#grupCabangTahfidz').on('change', function() {
                const idCabang = $(this).val();

                if (idCabang) {
                    $.ajax({
                        url: `/get-data-grup-santri/${idCabang}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#grupSantriTahfidz').find('option:not(:first)').remove();

                            // Tambahkan opsi baru
                            $.each(data, function(key, value) {
                                $('#grupSantriTahfidz').append(
                                    `<option value="${value.id}">${value.nama_grup}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data santri:', error);
                        }
                    });
                } else {
                    // Kosongkan Data Santri jika Grup Santri tidak dipilih
                    $('#grupSantriTahfidz').find('option:not(:first)').remove();
                }
            });

            // Ambil Data Kelompok Qur'an berdasarkan Grup Santri(Rombel) yang dipilih
            $('#grupSantriTahfidz').on('change', function() {
                const idKelompok = $(this).val();

                if (idKelompok) {
                    $.ajax({
                        url: `/get-data-grup-kelompok/${idKelompok}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#grupKelompokTahfidz').find('option:not(:first)').remove();

                            if(data.length === 0){
                                $('#grupKelompokTahfidz').append(
                                    `<option value="" disabled>Data kelompok qur'an tidak ada</option>`
                                );
                            } else {
                                // Tambahkan opsi baru
                                $.each(data, function(key, value) {
                                    $('#grupKelompokTahfidz').append(
                                        `<option value="${value.id}">${value.nama_kelompok}</option>`
                                    );
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data santri:', error);
                        }
                    });
                } else {
                    // Kosongkan Data Santri jika Grup Santri tidak dipilih
                    $('#grupKelompokTahfidz').find('option:not(:first)').remove();
                }
            });

            // Ambil Data Santri berdasarkan Grup yang dipilih
            $('#grupKelompokTahfidz').on('change', function() {
                const grupSantriId = $(this).val();

                if (grupSantriId) {
                    $.ajax({
                        url: `/get-data-santri-by-grup/${grupSantriId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#dataSantriTahfidz').find('option:not(:first)').remove();

                            // Jika data santri kosong, tampilkan pesan "Data santri tidak ada"
                            if (data.length === 0) {
                                $('#dataSantriTahfidz').append(
                                    `<option value="" disabled>Data santri tidak ada</option>`
                                );
                            } else {
                                // Tambahkan opsi baru jika ada data santri
                                $.each(data, function(key, value) {
                                    $('#dataSantriTahfidz').append(
                                        `<option value="${value.id}">${value.nama_lengkap}</option>`
                                    );
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data santri:', error);
                        }
                    });
                } else {
                    // Kosongkan Data Santri jika Grup Santri tidak dipilih
                    $('#dataSantriTahfidz').find('option:not(:first)').remove();
                }
            });

            // Ambil data Juz
            $.ajax({
                url: "{{ route('getDataJuz') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#juz').find('option:not(:first)').remove();
                    $.each(data, function(key, value) {
                        $('#juz').append(
                            `<option value="${value.id}">${value.nama_juz}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching juz:', error);
                }
            });

            // Ambil data Level berdasarkan Juz yang dipilih
            $('#juz').on('change', function() {
                const juzId = $(this).val();

                if (juzId) {
                    $.ajax({
                        url: `/get-data-level/${juzId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#levelTahfidz').find('option:not(:first)').remove();
                            $.each(data, function(key, value) {
                                $('#levelTahfidz').append(
                                    `<option value="${value.id}">${value.level}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching level:', error);
                        }
                    });
                } else {
                    $('#levelTahfidz').find('option:not(:first)').remove();
                }
            });

            // Ambil data Surah berdasarkan Level yang dipilih
            $('#levelTahfidz').on('change', function() {
                const levelId = $(this).val();

                if (levelId) {
                    $.ajax({
                        url: `/get-data-surah/${levelId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#surah').find('option:not(:first)').remove();
                            $.each(data, function(key, value) {
                                $('#surah').append(
                                    `<option value="${value.id}">${value.nama_surat}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching surah:', error);
                        }
                    });
                } else {
                    $('#surah').find('option:not(:first)').remove();
                }
            });
            
            // Ambil data Dropdown Surah Update berdasarkan id_juz_level yang dipilih
            const updateSurahDropdown = () => {
                fetch('/update-surah-data', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.success && Array.isArray(data.surah_data) && data.surah_data.length > 0) {
                            
                            const surahDropdown = $('#surahUpdate');
                            const selectedSurah = sessionStorage.getItem('selected_surah')
                                ? JSON.parse(sessionStorage.getItem('selected_surah'))
                                : [];
                            
                            surahDropdown.empty();

                            data.surah_data.forEach((surah) => {
                                if (!selectedSurah.includes(surah.id)) {
                                    surahDropdown.append(
                                        `<option value="${surah.id}">${surah.nama_surat}</option>`
                                    );
                                }
                            });

                            // alert('Dropdown surah berhasil diperbarui!');
                        } else {
                            // alert(data.message || 'Tidak ada data surah yang tersedia.');
                        }
                    })
                    .catch((error) => {
                        // console.error('Error updating surah data:', error);
                        // alert('Terjadi kesalahan saat memperbarui data surah.');
                    });
            };
            updateSurahDropdown();
        });
    </script>

@endsection
