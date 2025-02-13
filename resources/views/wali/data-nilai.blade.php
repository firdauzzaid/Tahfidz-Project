@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Data Absensi')

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
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center fw-bold mb-0">Data Nilai Santri</h5>
                    <p class="text-center mb-0">{{ $data['nama_santri'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Tabel Data Nilai Perkembangan Tahsin -->
                    <h6 class="fw-bold">Nilai Perkembangan Tahsin</h6>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Jilid</th>
                                    <th class="text-center">Halaman</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['nilai_ptahsin'] as $index => $ptahsin)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $ptahsin->nama_guru }}</td>
                                        <td class="text-center">{{ $ptahsin->tanggal }}</td>
                                        <td class="text-center">{{ $ptahsin->jilid }}</td>
                                        <td class="text-center">{{ $ptahsin->halaman }}</td>
                                        <td class="text-center">{{ $ptahsin->keterangan }}</td>
                                        <td class="text-center">{{ $ptahsin->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Tabel Data Nilai Perkembangan Tahfidz -->
                    <h6 class="fw-bold mt-4">Nilai Perkembangan Tahfidz</h6>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Nama Juz</th>
                                    <th class="text-center">Nama Surat</th>
                                    <th class="text-center">Ayat</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['nilai_ptahfidz'] as $index => $ptahfidz)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $ptahfidz->nama_guru }}</td>
                                        <td class="text-center">{{ $ptahfidz->tanggal }}</td>
                                        <td class="text-center">{{ $ptahfidz->nama_juz }}</td>
                                        <td class="text-center">{{ $ptahfidz->nama_surat }}</td>
                                        <td class="text-center">{{ $ptahfidz->ayat }}</td>
                                        <td class="text-center">{{ $ptahfidz->keterangan }}</td>
                                        <td class="text-center">{{ $ptahfidz->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <!-- Tabel Data Nilai Murojaah -->
                    <h6 class="fw-bold mt-4">Nilai Murojaah</h6>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Juz</th>
                                    <th class="text-center">Nama Surat</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['nilai_murojaah'] as $index => $murojaah)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $murojaah->nama_guru }}</td>
                                        <td class="text-center">{{ $murojaah->tanggal }}</td>
                                        <td class="text-center">{{ $murojaah->waktu }}</td>
                                        <td class="text-center">{{ $murojaah->juz }}</td>
                                        <td class="text-center">{{ $murojaah->nama_surah }}</td>
                                        <td class="text-center">{{ $murojaah->keterangan }}</td>
                                        <td class="text-center">{{ $murojaah->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tabel Data Nilai Tasmi -->
                    <h6 class="fw-bold mt-4">Nilai Tasmi</h6>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Juz</th>
                                    <th class="text-center">Tajwid</th>
                                    <th class="text-center">Fashohah</th>
                                    <th class="text-center">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['nilai_tasmi'] as $index => $tasmi)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $tasmi->nama_guru }}</td>
                                        <td class="text-center">{{ $tasmi->juz }}</td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column justify-content-start align-items-center">
                                                <p>Makharijul Huruf : <strong>{{ $tasmi->tajwid1 }}</strong></p>
                                                <p>Shifatul Huruf : <strong>{{ $tasmi->tajwid2 }}</strong></p>
                                                <p>Ahkamul Huruf : <strong>{{ $tasmi->tajwid3 }}</strong></p>
                                                <p>Ahkamul Mad Wal Qasr : <strong>{{ $tasmi->tajwid4 }}</strong></p>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column justify-content-start align-items-center">
                                                <p>Al-Waqf Wal Ibtida : <strong>{{ $tasmi->fashohah1 }}</strong></p>
                                                <p>Mura'atul Huruf Wal Harakah : <strong>{{ $tasmi->fashohah2 }}</strong></p>
                                                <p>Mura'atul Kalimat Wal Ayat : <strong>{{ $tasmi->fashohah3 }}</strong></p>
                                                <p>Adabut Tilawah : <strong>{{ $tasmi->fashohah4 }}</strong></p>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $tasmi->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
@endsection
