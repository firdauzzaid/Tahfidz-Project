@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard Wali')

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

    <div class="row mb-6">
        <a href="data-absensi" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-calendar ti-md'></i></span>
                        Data Absensi
                    </div>
                </div>
            </div>
        </a>
        <a href="data-nilai" class="col-6 col-md-3">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <span class="badge bg-label-primary rounded p-1_5 mb-2"><i
                                class='ti ti-file-analytics ti-md'></i></span>
                        Data Nilai
                    </div>
                </div>
            </div>
        </a>
    </div>
@endsection
