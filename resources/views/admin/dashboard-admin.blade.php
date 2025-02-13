@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard Admin')

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

    <div class="row g-6 mb-6">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="row p-0 m-0">
                        <li class="col-12 col-sm-6 d-flex align-items-center mb-5">
                            <div class="me-4">
                                <span class="badge bg-label-primary rounded p-1_5"><i class='ti ti-users ti-md'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Total Santri</h6>
                                    <small class="text-body">{{ $totalSantri }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="col-12 col-sm-6 d-flex align-items-center mb-5">
                            <div class="me-4">
                                <span class="badge bg-label-info rounded p-1_5"><i class='ti ti-user-star ti-md'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Total Guru</h6>
                                    <small class="text-body">{{ $totalGuru }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="col-12 col-sm-6 d-flex align-items-center mb-5">
                            <div class="me-4">
                                <span class="badge bg-label-success rounded p-1_5"><i
                                        class='ti ti-user-check ti-md'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Santri Lulus</h6>
                                    <small class="text-body">{{ $totalSantriLulus }}</small>
                                </div>
                            </div>
                        </li>
                        <li class="col-12 col-sm-6 d-flex align-items-center mb-5">
                            <div class="me-4">
                                <span class="badge bg-label-danger rounded p-1_5"><i class='ti ti-user-x ti-md'></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Santri Belum Lulus</h6>
                                    <small class="text-body">{{ $totalSantriBelumLulus }}</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-6">
        <a href="dashboard-admin" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i
                                class='ti ti-smart-home ti-md'></i></span>
                        Dashboard Admin
                    </div>
                </div>
            </div>
        </a>
        <a href="kelola-guru" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-user-star ti-md'></i></span>
                        Kelola Guru
                    </div>
                </div>
            </div>
        </a>
        <a href="kelola-santri" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i
                                class='ti ti-users-group ti-md'></i></span>
                        Kelola Santri
                    </div>
                </div>
            </div>
        </a>
        <a href="kelola-grup-cabang" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-category ti-md'></i></span>
                        Kelola Grup Kelas
                    </div>
                </div>
            </div>
        </a>
        <a href="kelola-grup-santri" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-category ti-md'></i></span>
                        Kelola Rombel
                    </div>
                </div>
            </div>
        </a>
        <a href="kelola-grup-kelompok" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-category ti-md'></i></span>
                        Kelola Kelompok Qur'an
                    </div>
                </div>
            </div>
        </a>
        <a href="kelola-juz" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-book ti-md'></i></span>
                        Kelola Juz
                    </div>
                </div>
            </div>
        </a>
        <a href="laporan" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-file ti-md'></i></span>
                        Laporan
                    </div>
                </div>
            </div>
        </a>
        <a href="pengaturan-website" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-settings ti-md'></i></span>
                        Pengaturan
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="row">
        <div class="col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Ringkasan Pendaftaran</h5>
                        <p class="card-subtitle  my-0">Grafik Pendaftaran Pengguna 30 Hari Terakhir</p>
                    </div>
                </div>
                <div class="card-body">
                    <div id="lineChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
