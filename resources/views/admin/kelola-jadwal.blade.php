@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Jadwal')

@section('content')
    @include('partials.alerts')

    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0">Data Jadwal</h5>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Guru</th>
                    <th class="text-center">Nama Santri</th>
                    <th class="text-center">Grup Cabang</th>
                    <th class="text-center">Grup Santri</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($guruDanSantri as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $item['guru']->nama_lengkap }}</td>
                        <td class="text-center">
                            @foreach ($item['santri'] as $santri)
                                {{ $santri->nama_lengkap }}<br>
                            @endforeach
                        </td>
                        <td class="text-center">{{ $item['guru']->nama_grup_cabang }}</td>
                        <td class="text-center">{{ $item['guru']->nama_grup_santri }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
@endsection
