@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Absen')

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
        <!-- Form Kelola Absen -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3>Kelola Absen</h3>
                    <form action="/simpan-absensi" method="POST">
                        @csrf
                        <!-- Dropdown Grup Santri -->
                        <div class="mb-3">
                            <label for="grupCabangAbsen" class="form-label">Kelas</label>
                                <select class="form-select" id="grupCabangAbsen" name="grup_cabang" required>
                                <option selected>Pilih Kelas</option>
                                <!-- Options Here -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="grupSantriAbsen" class="form-label">Rombel</label>
                            <select class="form-select" id="grupSantriAbsen" name="grup_santri" required>
                                <option selected>Pilih Rombel</option>
                                <!-- Options Here -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="grupKelompokAbsen" class="form-label">Kelompok Qur'an</label>
                            <select class="form-select" id="grupKelompokAbsen" name="grup_kelompok" required>
                                <option selected>Pilih Kelompok Qur'an</option>
                                <!-- Options Here -->
                            </select>
                        </div>
                    
                        <!-- Tabel Data Santri -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataSantriTable">
                                <thead>
                                    <tr>
                                        <th>Nama Santri</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data Santri akan dimuat di sini -->
                                </tbody>
                            </table>
                        </div>
                    <div class="mb-3">
                        <label for="tanggalAbsensi" class="form-label">Tanggal</label>
                        <input type="date" id="tanggalAbsensi" name="tanggal_absensi" class="form-control" disabled>
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const inputTanggal = document.getElementById('tanggalAbsensi');
                            const today = new Date().toISOString().split('T')[0]; // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
                            inputTanggal.value = today; // Set nilai default input tanggal
                        });
                    </script>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <h3 class="p-3 text-center">Daftar Siswa - Kelola Absen</h3>
                <div class="d-flex flex-row justify-content-center align-items-center mb-4">
                    <a href="/cetak-data-absensi" class="btn btn-primary">Cetak Data Absensi</a>
                </div>
                <div class="card-body mt-4 pt-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Santri</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal Kehadiran</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $item->nama_santri }}</td>
                                        <td class="text-center">{{ $item->nama_guru }}</td>
                                        <td class="text-center">{{ $item->status == 1 ? 'Ya' : 'Tidak' }}</td>
                                        <td class="text-center">{{ $item->tanggal_absensi }}</td>
                                        <td class="text-center">
                                            <div class="d-flex flex-row justify-content-center">
                                                <!-- Button Hapus -->
                                                <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditAbsen{{ $item->id }}">
                                                    <i class="ti ti-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusAbsen{{ $item->id }}">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal Edit Absen -->
                                    @foreach($data as $item)
                                        <div class="modal fade" id="modalEditAbsen{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <form action="/edit-absensi/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="editDataSantri{{ $item->id }}" class="form-label">Data Santri</label>
                                                                <select class="form-select" id="editDataSantri{{ $item->id }}" name="id_santri" disabled>
                                                                    @foreach($dataSantri as $santri)
                                                                        @if($santri->id == $item->id_santri)
                                                                            <option value="{{ $santri->id }}" selected>
                                                                                {{ $santri->nama_lengkap }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tanggalAbsensi" class="form-label">Tanggal Absensi</label>
                                                                <input type="date" id="tanggalAbsensi" name="tanggal_absensi" class="form-control" value="{{ $item->tanggal_absensi }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="editStatus{{ $item->id }}" class="form-label">Status</label>
                                                                <select name="status" id="editStatus{{ $item->id }}" class="form-control" required>
                                                                    <option value="" disabled>Pilih Salah Satu</option>
                                                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Ya</option>
                                                                    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Tidak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach($data as $item)
                                    <!-- Modal Hapus Absen -->
                                    <div class="modal fade" id="modalHapusAbsen{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/hapus-absensi/{{ $item->id }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
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
                                    @endforeach
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
                        $('#grupCabangAbsen').find('option:not(:first)').remove();

                        // Tambahkan opsi baru
                        $.each(data, function(key, value) {
                            $('#grupCabangAbsen').append(
                                `<option value="${value.id}">${value.nama_grup}</option>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching grup santri:', error);
                    }
            });

            // Ambil Data Grup Santri(Rombel) berdasarkan Grup Cabang(Kelas) yang dipilih
                $('#grupCabangAbsen').on('change', function() {
                        const idCabang = $(this).val();

                        if (idCabang) {
                            $.ajax({
                                url: `/get-data-grup-santri/${idCabang}`,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    // Hapus opsi lama kecuali opsi pertama
                                    $('#grupSantriAbsen').find('option:not(:first)').remove();

                                    // Tambahkan opsi baru
                                    $.each(data, function(key, value) {
                                        $('#grupSantriAbsen').append(
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
                            $('#grupSantriAbsen').find('option:not(:first)').remove();
                        }
            });

            // Ambil Data Kelompok Qur'an berdasarkan Grup Santri(Rombel) yang dipilih
            $('#grupSantriAbsen').on('change', function() {
                const idKelompok = $(this).val();

                if (idKelompok) {
                            $.ajax({
                                url: `/get-data-grup-kelompok/${idKelompok}`,
                                type: "GET",
                                dataType: "json",
                                success: function(data) {
                                    // Hapus opsi lama kecuali opsi pertama
                                    $('#grupKelompokAbsen').find('option:not(:first)').remove();

                                    if(data.length === 0){
                                        $('#grupKelompokTahfidz').append(
                                            `<option value="" disabled>Data kelompok qur'an tidak ada</option>`
                                        );
                                    } else {
                                        // Tambahkan opsi baru
                                        $.each(data, function(key, value) {
                                            $('#grupKelompokAbsen').append(
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
                    $('#grupKelompokAbsen').find('option:not(:first)').remove();
                }
            });

            // Ambil Data Santri berdasarkan Grup Santri yang dipilih
            $('#grupKelompokAbsen').on('change', function() {
                const grupSantriId = $(this).val();

                if (grupSantriId) {
                    $.ajax({
                        url: `/get-data-santri-by-grup/${grupSantriId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Kosongkan tabel data santri
                            const tbody = $('#dataSantriTable tbody');
                            tbody.empty();

                            // Tambahkan baris baru untuk setiap santri
                            $.each(data, function(key, value) {
                                const row = `
                                    <tr>
                                        <td>${value.nama_lengkap}</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status[${value.id}]" value="1" required>
                                                <label class="form-check-label">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status[${value.id}]" value="0" required>
                                                <label class="form-check-label">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                                tbody.append(row);
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching data santri:', error);
                        }
                    });
                } else {
                    // Kosongkan tabel jika Grup Santri tidak dipilih
                    $('#dataSantriTable tbody').empty();
                }
            });
        });
    </script>
@endsection
