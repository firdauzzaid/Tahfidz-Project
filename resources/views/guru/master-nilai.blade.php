@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Master Nilai')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/tagify/tagify.scss',
  'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
  'resources/assets/vendor/libs/typeahead-js/typeahead.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/tagify/tagify.js',
  'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
  'resources/assets/vendor/libs/typeahead-js/typeahead.js',
  'resources/assets/vendor/libs/bloodhound/bloodhound.js'
])
@endsection

@section('page-script')
    @vite(['resources/assets/js/charts-apex.js'])
@endsection

@section('content')
@include('partials.alerts')
<div class="row mb-6">
  <a href="perkembangan-tahsin" class="col-6 col-md-3">
      <div class="card mb-2">
          <div class="card-body">
              <div class="d-flex flex-column justify-content-center align-items-center text-center">
                  <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-book ti-md'></i></span>
                  Perkembangan Tahsin
              </div>
          </div>
      </div>
  </a>
  <a href="perkembangan-tahfidz" class="col-6 col-md-3">
      <div class="card mb-2">
          <div class="card-body">
              <div class="d-flex flex-column justify-content-center align-items-center text-center">
                  <span class="badge bg-label-primary rounded p-1_5 mb-2"><i
                          class='ti ti-book ti-md'></i></span>
                  Perkembangan Tahfidz
              </div>
          </div>
      </div>
  </a>
  <a href="murojaah" class="col-6 col-md-3">
      <div class="card mb-2">
          <div class="card-body">
              <div class="d-flex flex-column justify-content-center align-items-center text-center">
                  <span class="badge bg-label-primary rounded p-1_5 mb-2"><i
                          class='ti ti-book ti-md'></i></span>
                  Murojaah Di Rumah
              </div>
          </div>
      </div>
  </a>
  <a href="munaqasyah-tahsin" class="col-6 col-md-3">
      <div class="card mb-2">
          <div class="card-body">
              <div class="d-flex flex-column justify-content-center align-items-center text-center">
                  <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-book ti-md'></i></span>
                  Munaqasyah Tahsin
              </div>
          </div>
      </div>
  </a>
  <a href="munaqasyah-tahfidz" class="col-6 col-md-3">
      <div class="card mb-2">
          <div class="card-body">
              <div class="d-flex flex-column justify-content-center align-items-center text-center">
                  <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-book ti-md'></i></span>
                  Munaqasyah Tahfidz
              </div>
          </div>
      </div>
  </a>
  <a href="tasmi" class="col-6 col-md-3">
      <div class="card mb-2">
          <div class="card-body">
              <div class="d-flex flex-column justify-content-center align-items-center text-center">
                  <span class="badge bg-label-primary rounded p-1_5 mb-2"><i class='ti ti-book ti-md'></i></span>
                  Tasmi'
              </div>
          </div>
      </div>
  </a>
</div>

@endsection
