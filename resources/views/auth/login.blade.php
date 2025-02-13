@php
    $isNavbar = false;
    $isMenu = false;
    $isFooter = false;
    $customizerHidden = 'customizer-hide';
    $dataWeb = Helper::berandaUser();

@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
    @include('partials.alerts')
<style>
    .layout-container {
        background-image: url('{{asset('assets/img/home/Hero Banner Yayasan Tsabata.png')}}');
        background-size: cover; /* Menyesuaikan gambar agar menutupi seluruh elemen */
        background-position: center; /* Memposisikan gambar di tengah */
        background-repeat: no-repeat; /* Mencegah pengulangan gambar */
        height: 100%; /* Mengatur tinggi elemen agar penuh */
        width: 100%; /* Mengatur lebar elemen agar penuh */
    }
</style>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{ url('/') }}"
                                class="d-flex flex-column justify-content-center align-items-center ">
                                <h4 class="mb-1 fw-bold">TSABATA</h4>
                                <img src="{{ $dataWeb['logo_website'] }}" style="width: 150px;">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 text-center">LOGIN</h4>
                        <p class="mb-6 text-center">Silahkan Masukkan Kredensial Anda Dengan Benar</p>

                        <form id="formAuthentication" class="mb-4" action="{{ route('cek-login') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email / Username</label>
                                <input type="text" class="form-control" id="email" name="identifier"
                                    placeholder="Masukkan Email/Username Anda" autofocus>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">LOGIN</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
