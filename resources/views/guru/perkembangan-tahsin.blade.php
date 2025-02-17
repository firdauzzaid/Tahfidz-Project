@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Perkembangan Tahsin')

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
        <!-- Form Perkembangan Tahsin -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3>Perkembangan Tahsin</h3>
                    @if(!session('nilaiId'))
                        <form action="/simpan-perkembangan-tahsin" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="grupCabangTahsin" class="form-label">Kelas</label>
                                <select class="form-select" id="grupCabangTahsin" name="grup_cabang" required>
                                    <option selected>Pilih Kelas</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="grupSantriTahsin" class="form-label">Rombel</label>
                                <select class="form-select" id="grupSantriTahsin" name="grup_santri" required>
                                    <option selected>Pilih Rombel</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="grupKelompokTahsin" class="form-label">Kelompok Qur'an</label>
                                <select class="form-select" id="grupKelompokTahsin" name="grup_kelompok" required>
                                    <option selected>Pilih Kelompok Qur'an</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="dataSantriTahsin" class="form-label">Data Santri</label>
                                <select class="form-select" id="dataSantriTahsin" name="id_santri" required>
                                    <option selected>Pilih Data Santri</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="mb-3">
                                <label for="jilid" class="form-label">Jilid</label>
                                <input type="text" class="form-control" placeholder="Masukkan Jilid" id="jilid"
                                    name="jilid" required>
                            </div>

                            <div class="mb-3">
                                <label for="halaman" class="form-label">Halaman</label>
                                <input type="text" class="form-control" placeholder="Masukkan Halaman" id="halaman"
                                    name="halaman" required>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" placeholder="Masukkan Keterangan" id="keterangan"
                                    name="keterangan" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <!-- Penilaian data lanjutan -->
                        <form action="/simpan-data-lanjutan-ptahsin" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="grupCabangTahsin" class="form-label">Kelas</label>
                                <input type="text" class="form-select" id="grupCabangTahsin" value="{{ session('namaGrupCabang')->nama_grup ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="grupSantriTahsin" class="form-label">Rombel</label>
                                <input type="text" class="form-select" id="grupSantriTahsin" value="{{ session('namaGrupSantri')->nama_grup ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="grupKelompokTahsin" class="form-label">Kelompok Qur'an</label>
                                <input type="text" class="form-select" id="grupKelompokTahsin" value="{{ session('namaGrupKelompok')->nama_kelompok ?? 'Data Tidak Ditemukan' }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="santriUpdate" class="form-label">Data Santri</label>
                                <select class="form-select" id="santriUpdate" name="id_santri" required>
                                    <option selected>Pilih Data Santri</option>
                                    <!-- Options Here -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>

                            <div class="mb-3">
                                <label for="jilid" class="form-label">Jilid</label>
                                <input type="text" class="form-control" placeholder="Masukkan Jilid" id="jilid"
                                    name="jilid" required>
                            </div>

                            <div class="mb-3">
                                <label for="halaman" class="form-label">Halaman</label>
                                <input type="text" class="form-control" placeholder="Masukkan Halaman" id="halaman"
                                    name="halaman" required>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" placeholder="Masukkan Keterangan" id="keterangan"
                                    name="keterangan" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('guru.tambahDataAwalPTahsin') }}" class="btn btn-secondary">Data Baru</a>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <div class="card">
                <h3 class="p-3 text-center">Daftar Siswa - Perkembangan Tahsin</h3>
                <div class="d-flex flex-row justify-content-center align-items-center mb-4">
                    <a href="/cetak-data-perkembangan-tahsin" class="btn btn-primary">Cetak Data Perkembangan Tahsin</a>
                </div>
                <div class="card-body mt-0 pt-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Santri</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Jilid</th>
                                    <th class="text-center">Halaman</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Dibuat Pada</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($data as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $item->nama_santri }}</td>
                                        <td class="text-center">{{ $item->nama_guru }}</td>
                                        <td class="text-center">{{ $item->jilid }}</td>
                                        <td class="text-center">{{ $item->halaman }}</td>
                                        <td class="text-center">{{ $item->tanggal }}</td>
                                        <td class="text-center">{{ $item->keterangan }}</td>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                <!-- Button Edit -->
                                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditData{{ $item->id }}">
                                                    <i class="ti ti-edit me-2"></i>Edit
                                                </button>
                                                <!-- Button Delete -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusData{{ $item->id }}">
                                                    <i class="ti ti-trash me-2"></i>Hapus
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
                                                <form action="/edit-perkembangan-tahsin/{{ $item->id }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <!-- Form untuk edit -->
                                                        <div class="mb-3">
                                                            <label for="dataSantriTahsin" class="form-label">Data Santri</label>
                                                            <select class="form-select" id="dataSantriTahsin" name="id_santri" required>
                                                                <option selected>{{ $item->nama_santri }}</option>
                                                                <!-- Options Here -->
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="jilid" class="form-label">Jilid</label>
                                                            <input type="text" name="jilid" class="form-control"
                                                                value="{{ $item->jilid }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="halaman" class="form-label">Halaman</label>
                                                            <input type="text" name="halaman" class="form-control"
                                                                value="{{ $item->halaman }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="keterangan" class="form-label">Keterangan</label>
                                                            <textarea name="keterangan" class="form-control" required>{{ $item->keterangan }}</textarea>
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

                                    <!-- Modal Hapus Data -->
                                    <div class="modal fade" id="modalHapusData{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="/hapus-perkembangan-tahsin/{{ $item->id }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data ini? Data yang dihapus
                                                            tidak dapat
                                                            dikembalikan.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum Ada Data</td>
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
                    $('#grupCabangTahsin').find('option:not(:first)').remove();

                    // Tambahkan opsi baru
                    $.each(data, function(key, value) {
                        $('#grupCabangTahsin').append(
                            `<option value="${value.id}">${value.nama_grup}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching grup santri:', error);
                }
            });

            // Ambil Data Grup Santri(Rombel) berdasarkan Grup Cabang(Kelas) yang dipilih
            $('#grupCabangTahsin').on('change', function() {
                const idCabang = $(this).val();

                if (idCabang) {
                    $.ajax({
                        url: `/get-data-grup-santri/${idCabang}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#grupSantriTahsin').find('option:not(:first)').remove();

                            // Tambahkan opsi baru
                            $.each(data, function(key, value) {
                                $('#grupSantriTahsin').append(
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
                    $('#grupSantriTahsin').find('option:not(:first)').remove();
                }
            });

            // Ambil Data Kelompok Qur'an berdasarkan Grup Santri(Rombel) yang dipilih
            $('#grupSantriTahsin').on('change', function() {
                const idKelompok = $(this).val();

                if (idKelompok) {
                    $.ajax({
                        url: `/get-data-grup-kelompok/${idKelompok}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#grupKelompokTahsin').find('option:not(:first)').remove();

                            if(data.length === 0){
                                $('#grupKelompokTahsin').append(
                                    `<option value="" disabled>Data kelompok qur'an tidak ada</option>`
                                );
                            } else {
                                // Tambahkan opsi baru
                                $.each(data, function(key, value) {
                                    $('#grupKelompokTahsin').append(
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
                    $('#grupKelompokTahsin').find('option:not(:first)').remove();
                }
            });

            // Ambil Data Santri berdasarkan Grup yang dipilih
            $('#grupKelompokTahsin').on('change', function() {
                const grupSantriId = $(this).val();

                if (grupSantriId) {
                    $.ajax({
                        url: `/get-data-santri-by-grup/${grupSantriId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#dataSantriTahsin').find('option:not(:first)').remove();

                            // Jika data santri kosong, tampilkan pesan "Data santri tidak ada"
                            if (data.length === 0) {
                                $('#dataSantriTahsin').append(
                                    `<option value="" disabled>Data santri tidak ada</option>`
                                );
                            } else {
                                // Tambahkan opsi baru jika ada data santri
                                $.each(data, function(key, value) {
                                    $('#dataSantriTahsin').append(
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
                    $('#dataSantriTahsin').find('option:not(:first)').remove();
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
