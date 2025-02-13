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
                    <form action="/simpan-tasmi" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="grupSantriTahfidz" class="form-label">Grup Santri</label>
                            <select class="form-select" id="grupSantriTahfidz" name="grup_santri" required>
                                <option selected>Pilih Grup Santri</option>
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
                                        <td class="text-center">{{ $item->juz }}</td>
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
                                                <!-- Button Hapus -->
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalHapusTasmi{{ $item->id }}">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

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
            // Ambil data Grup Santri
            $.ajax({
                url: "{{ route('getGrupSantri') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Hapus opsi lama kecuali opsi pertama
                    $('#grupSantriTahfidz').find('option:not(:first)').remove();

                    // Tambahkan opsi baru
                    $.each(data, function(key, value) {
                        $('#grupSantriTahfidz').append(
                            `<option value="${value.id}">${value.nama_grup}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching grup santri:', error);
                }
            });

            // Ambil Data Santri berdasarkan Grup Santri yang dipilih
            $('#grupSantriTahfidz').on('change', function() {
                const grupSantriId = $(this).val();

                if (grupSantriId) {
                    $.ajax({
                        url: `/get-data-santri-by-grup/${grupSantriId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#dataSantriTahfidz').find('option:not(:first)').remove();

                            // Tambahkan opsi baru
                            $.each(data, function(key, value) {
                                $('#dataSantriTahfidz').append(
                                    `<option value="${value.id}">${value.nama_lengkap}</option>`
                                );
                            });
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
                            `<option value="${value.nama_juz}">${value.nama_juz}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching juz:', error);
                }
            });
        });
    </script>


@endsection
