@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Tasmi')

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
        <!-- Form Tasmi -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>Tasmi</h3>

                    <!-- Form Data Utama (Grup, Santri, Tanggal, Juz) -->
                    @if(!session('nilaiId'))
                        <form action="/simpan-tasmi" method="POST">
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
                                <label for="juz" class="form-label">Juz</label>
                                <select class="form-select" id="juz" name="juz">
                                    <option selected>Pilih Juz</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="" selected>Pilih Status</option>
                                    <option value="1">Lulus</option>
                                    <option value="0">Belum Lulus</option>
                                </select>
                            </div>

                            <h5 class="fw-bold text-muted">Bidang Tajwid</h5>

                            <div class="mb-3">
                                <label for="tajwid1" class="form-label">Makhrijul Huruf</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Makhrijul Huruf"
                                    id="tajwid1" name="tajwid1" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid2" class="form-label">Shifatul Huruf</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Shifatul Huruf"
                                    id="tajwid2" name="tajwid2" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid3" class="form-label">Ahkamul Huruf</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Ahkamul Huruf"
                                    id="tajwid3" name="tajwid3" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid4" class="form-label">Ahkamul Mad wal Qashr</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Ahkamul Mad wal Qashr"
                                    id="tajwid4" name="tajwid4" required>
                            </div>

                            <h5 class="fw-bold text-muted">Bidang Fashohah</h5>

                            <div class="mb-3">
                                <label for="fashohah1" class="form-label">Al-Waqf wal Ibtida</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Al-Waqf wal Ibtida"
                                    id="fashohah1" name="fashohah1" required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah2" class="form-label">Mura'atul Huruf wal Harakah</label>
                                <input type="text" class="form-control"
                                    placeholder="Masukkan Nilai Mura'atul Huruf wal Harakah" id="fashohah2" name="fashohah2"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah3" class="form-label">Mura'atul Kalimat wal Ayat</label>
                                <input type="text" class="form-control"
                                    placeholder="Masukkan Nilai Mura'atul Kalimat wal Ayat" id="fashohah3" name="fashohah3"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah4" class="form-label">Adabut Tilawah</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Adabut Tilawah"
                                    id="fashohah4" name="fashohah4" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                    <!-- Penilaian data lenjutan -->
                        <form action="/simpan-data-lanjutan-tasmi" method="POST">
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
                                <label for="santriUpdate" class="form-label">Data Santri</label>
                                <select class="form-select" id="santriUpdate" name="id_santri" required>
                                    <option selected>Pilih Data Santri</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="juz" class="form-label">Juz</label>
                                <select class="form-select" id="juz" name="juz">
                                    <option selected>Pilih Juz</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="" selected>Pilih Status</option>
                                    <option value="1">Lulus</option>
                                    <option value="0">Belum Lulus</option>
                                </select>
                            </div>

                            <h5 class="fw-bold text-muted">Bidang Tajwid</h5>

                            <div class="mb-3">
                                <label for="tajwid1" class="form-label">Makhrijul Huruf</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Makhrijul Huruf"
                                    id="tajwid1" name="tajwid1" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid2" class="form-label">Shifatul Huruf</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Shifatul Huruf"
                                    id="tajwid2" name="tajwid2" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid3" class="form-label">Ahkamul Huruf</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Ahkamul Huruf"
                                    id="tajwid3" name="tajwid3" required>
                            </div>

                            <div class="mb-3">
                                <label for="tajwid4" class="form-label">Ahkamul Mad wal Qashr</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Ahkamul Mad wal Qashr"
                                    id="tajwid4" name="tajwid4" required>
                            </div>

                            <h5 class="fw-bold text-muted">Bidang Fashohah</h5>

                            <div class="mb-3">
                                <label for="fashohah1" class="form-label">Al-Waqf wal Ibtida</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Al-Waqf wal Ibtida"
                                    id="fashohah1" name="fashohah1" required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah2" class="form-label">Mura'atul Huruf wal Harakah</label>
                                <input type="text" class="form-control"
                                    placeholder="Masukkan Nilai Mura'atul Huruf wal Harakah" id="fashohah2" name="fashohah2"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah3" class="form-label">Mura'atul Kalimat wal Ayat</label>
                                <input type="text" class="form-control"
                                    placeholder="Masukkan Nilai Mura'atul Kalimat wal Ayat" id="fashohah3" name="fashohah3"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="fashohah4" class="form-label">Adabut Tilawah</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nilai Adabut Tilawah"
                                    id="fashohah4" name="fashohah4" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="{{ route('guru.tambahDataAwalTasmi') }}" class="btn btn-secondary">Data Baru</a>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <h3 class="p-3 text-center">Daftar Siswa - Tasmi</h3>
                <div class="card-body mt-0 pt-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Santri</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Juz</th>
                                    <th class="text-center">Makhrijul Huruf</th>
                                    <th class="text-center">Shifatul Huruf</th>
                                    <th class="text-center">Ahkamul Huruf</th>
                                    <th class="text-center">Ahkamul Mad wal Qashr</th>
                                    <th class="text-center">Al-Waqf wal Ibtida</th>
                                    <th class="text-center">Mura'atul Huruf wal Harakah</th>
                                    <th class="text-center">Mura'atul Kalimat wal Ayat</th>
                                    <th class="text-center">Adabut Tilawah</th>
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
                                        <td class="text-center">{{ $item->nama_juz }}</td>
                                        <td class="text-center">{{ $item->tajwid1 }}</td>
                                        <td class="text-center">{{ $item->tajwid2 }}</td>
                                        <td class="text-center">{{ $item->tajwid3 }}</td>
                                        <td class="text-center">{{ $item->tajwid4 }}</td>
                                        <td class="text-center">{{ $item->fashohah1 }}</td>
                                        <td class="text-center">{{ $item->fashohah2 }}</td>
                                        <td class="text-center">{{ $item->fashohah3 }}</td>
                                        <td class="text-center">{{ $item->fashohah4 }}</td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex flex-row justify-content-center">
                                                <!-- Button Edit -->
                                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditData{{ $item->id }}">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </button>
                                                <!-- Button Hapus -->
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusTasmi{{ $item->id }}">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Data -->
                                    <div class="modal fade" id="modalEditData{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="/edit-tasmi/{{ $item->id }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <!-- Form untuk edit -->
                                                        <div class="mb-3">
                                                            <label for="dataSantriTahfidz" class="form-label">Data Santri</label>
                                                            <select class="form-select" id="dataSantriTahfidz">
                                                                <option selected>{{ $item->nama_santri }}</option>
                                                                <!-- Options Here -->
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="juz" class="form-label">Juz</label>
                                                            <select class="form-select" id="juz">
                                                                <option selected>{{ $item->nama_juz }}</option>
                                                                <!-- Options Here -->
                                                            </select>
                                                        </div>

                                                        <h5 class="fw-bold text-muted">Bidang Tajwid</h5>

                                                        <div class="mb-3">
                                                            <label for="tajwid1" class="form-label">Makhrijul Huruf</label>
                                                            <input type="text" class="form-control" id="tajwid1" name="tajwid1" value="{{ $item->tajwid1 }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="tajwid2" class="form-label">Shifatul Huruf</label>
                                                            <input type="text" class="form-control" id="tajwid2" name="tajwid2" value="{{ $item->tajwid2 }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="tajwid3" class="form-label">Ahkamul Huruf</label>
                                                            <input type="text" class="form-control" id="tajwid3" name="tajwid3" value="{{ $item->tajwid3 }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="tajwid4" class="form-label">Ahkamul Mad wal Qashr</label>
                                                            <input type="text" class="form-control" id="tajwid4" name="tajwid4" value="{{ $item->tajwid4 }}" required>
                                                        </div>

                                                        <h5 class="fw-bold text-muted">Bidang Fashohah</h5>

                                                        <div class="mb-3">
                                                            <label for="fashohah1" class="form-label">Al-Waqf wal Ibtida</label>
                                                            <input type="text" class="form-control" id="fashohah1" name="fashohah1" value="{{ $item->fashohah1 }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="fashohah2" class="form-label">Mura'atul Huruf wal Harakah</label>
                                                            <input type="text" class="form-control" id="fashohah2" name="fashohah2" value="{{ $item->fashohah2 }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="fashohah3" class="form-label">Mura'atul Kalimat wal Ayat</label>
                                                            <input type="text" class="form-control" id="fashohah3" name="fashohah3" value="{{ $item->fashohah3 }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="fashohah4" class="form-label">Adabut Tilawah</label>
                                                            <input type="text" class="form-control" id="fashohah4" name="fashohah4" value="{{ $item->fashohah4 }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus Tasmi -->
                                    <div class="modal fade" id="modalHapusTasmi{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/hapus-tasmi/{{ $item->id }}" method="POST">
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

            // Ambil data Dropdown Surah Update berdasarkan id_juz_level yang dipilih
            const updateSantriDropdown = () => {
                fetch('/update-santri-data', {
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
                    if (data.success && Array.isArray(data.santri_data) && data.santri_data.length > 0) {
                        
                        const santriDropdown = $('#santriUpdate');
                        const selectedSantri = sessionStorage.getItem('selected_santri')
                            ? JSON.parse(sessionStorage.getItem('selected_santri'))
                            : [];
                        
                        santriDropdown.empty();

                        data.santri_data.forEach((santri) => {
                            if (!selectedSantri.includes(santri.id)) {
                                santriDropdown.append(
                                    `<option value="${santri.id}">${santri.nama_lengkap}</option>`
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
            updateSantriDropdown();
        });
    </script>
@endsection
