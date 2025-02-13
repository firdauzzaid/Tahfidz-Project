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
    @include('partials.alerts')
    <div class="col-12">
        <div class="card mb-2">
            <h5 class="card-header"> Pengaturan Website</h5>
            <div class="card-body">
                <form action="/update-website" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_website">Nama Website</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Website" name="nama_website"
                            value="{{ old('nama_website', $settings->nama_website ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_website">Deskripsi Website</label>
                        <input type="text" class="form-control" placeholder="Masukkan Deskripsi Website"
                            name="deskripsi_website"
                            value="{{ old('deskripsi_website', $settings->deskripsi_website ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="keyword_website">Keyword Website</label>
                        <input type="text" class="form-control" placeholder="Masukkan Keyword Website"
                            name="keyword_website" value="{{ old('keyword_website', $settings->keyword_website ?? '') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="logo_website">Logo Website</label>
                        <div class="mb-3 d-flex justify-content-center align-items-center">
                          <img id="preview-logo"
                          src="{{ !empty($settings->logo_website) ? asset('storage/' . $settings->logo_website) : 'https://placehold.co/400' }}"
                          class="rounded" alt="Logo Website" width="200">


                        </div>
                        <input type="file" class="form-control" name="logo_website" id="logo-website-input"
                            accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="email_website">Email Website</label>
                        <input type="text" class="form-control" placeholder="Masukkan Email Website" name="email_website"
                            value="{{ old('email_website', $settings->email_website ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="telpon_website">Telpon Website</label>
                        <input type="text" class="form-control" placeholder="Masukkan Telpon Website"
                            name="telpon_website" value="{{ old('telpon_website', $settings->telpon_website ?? '') }}"
                            required>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('logo-website-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                // Saat file selesai dibaca, set src dari img untuk preview
                reader.onload = function(e) {
                    document.getElementById('preview-logo').src = e.target.result;
                };

                // Baca file sebagai Data URL
                reader.readAsDataURL(file);
            }
        });
    </script>

@endsection
