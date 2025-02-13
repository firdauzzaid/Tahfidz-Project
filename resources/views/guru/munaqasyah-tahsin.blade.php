@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Munaqasyah Tahsin')

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
        <!-- Form Munaqasyah Tahsin -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3>Munaqasyah Tahsin (Data Raport)</h3>
                    <form action="/simpan-munaqasyah-tahsin" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="grupSantriTahsin" class="form-label">Grup Santri</label>
                            <select class="form-select" id="grupSantriTahsin" name="grup_santri">
                                <option selected>Pilih Grup Santri</option>
                                <!-- Options Here -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dataSantriTahsin" class="form-label">Data Santri</label>
                            <select class="form-select" id="dataSantriTahsin" name="id_santri">
                                <option selected>Pilih Data Santri</option>
                                <!-- Options Here -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jilid" class="form-label">Jilid</label>
                            <input type="text" class="form-control" id="jilid" name="jilid">
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Halaman</label>
                            <input type="text" class="form-control" id="level" name="level">
                        </div>

                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="text" class="form-control" id="nilai" name="nilai">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <h3 class="p-3 text-center">Daftar Siswa - Munaqasyah Tahsin</h3>
                <div class="d-flex flex-row justify-content-center align-items-center mb-4">
                    <a href="/cetak-data-munaqasyah-tahsin" class="btn btn-primary">Cetak Data Munaqasyah Tahsin</a>
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
                                    <th class="text-center">Nilai</th>
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
                                        <td class="text-center">{{ $item->jilid }}</td>
                                        <td class="text-center">{{ $item->level }}</td>
                                        <td class="text-center">{{ $item->nilai }}</td>
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
                                    <div class="modal fade" id="modalHapusMurojaah{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form action="/hapus-munaqasyah-tahsin/{{ $item->id }}" method="POST">
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
                    $('#grupSantriTahsin').find('option:not(:first)').remove();

                    // Tambahkan opsi baru
                    $.each(data, function(key, value) {
                        $('#grupSantriTahsin').append(
                            `<option value="${value.id}">${value.nama_grup}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching grup santri:', error);
                }
            });

            // Ambil Data Santri berdasarkan Grup Santri yang dipilih
            $('#grupSantriTahsin').on('change', function() {
                const grupSantriId = $(this).val();

                if (grupSantriId) {
                    $.ajax({
                        url: `/get-data-santri-by-grup/${grupSantriId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // Hapus opsi lama kecuali opsi pertama
                            $('#dataSantriTahsin').find('option:not(:first)').remove();

                            // Tambahkan opsi baru
                            $.each(data, function(key, value) {
                                $('#dataSantriTahsin').append(
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
                    $('#dataSantriTahsin').find('option:not(:first)').remove();
                }
            });
        });
    </script>
@endsection
