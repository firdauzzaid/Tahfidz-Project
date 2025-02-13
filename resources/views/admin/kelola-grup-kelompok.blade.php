@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Grup Kelompok')

@section('content')
@include('partials.alerts')

<div class="card">
  <div class="card-header d-flex flex-row justify-content-between align-items-center border-bottom">
      <h5 class="card-title mb-0">Kelola Grup Kelompok</h5>
      <div class="demo-inline-spacing">
          <button href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahData"
              class="btn btn-sm btn-primary"><i class="ti ti-category me-2"></i>Tambah Kelompok</button>
      </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">Nama Kelompok</th>
          <th class="text-center">Jumlah</th>
          <th class="text-center">Dibuat Pada</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($grupKelompok as $index => $kelompok)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td class="text-center">{{ $kelompok->nama_kelompok }}</td>
            <td class="text-center">{{ $kelompok->jumlah }}</td>
            <td class="text-center">{{ $kelompok->created_at }}</td>
            <td>
              <div class="d-flex flex-row justify-content-center align-items-center">
                <!-- Button Edit -->
                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" 
                        data-bs-target="#modalEditData{{ $kelompok->id }}">
                  <i class="ti ti-edit me-2"></i>Edit
                </button>
                <!-- Button Delete -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                        data-bs-target="#modalHapusData{{ $kelompok->id }}">
                  <i class="ti ti-trash me-2"></i>Hapus
                </button>
              </div>
            </td>
          </tr>
    
          <!-- Modal Edit Data -->
          <div class="modal fade" id="modalEditData{{ $kelompok->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Kelompok</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/edit-grup-kelompok/{{ $kelompok->id }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $kelompok->id }}">
                    <label for="grup_santri" class="form-label">Kelas</label>
                        <select class="form-select" id="grupSantriSelect" name="grup_santri" required>
                            @foreach ($grupSantri as $santri)
                                <option value="{{ $santri->id }}" {{ $kelompok->id_rombel == $santri->id ? 'selected' : '' }}>
                                    {{ $santri->nama_grup }}
                                </option>
                            @endforeach
                        </select>
                    <div class="mb-3">
                      <label for="nama_kelompok" class="form-label">Nama Kelompok</label>
                      <input type="text" name="nama_kelompok" class="form-control" value="{{ $kelompok->nama_kelompok }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_kelompok" class="form-label">Jumlah Kelompok</label>
                      <input type="text" name="jumlah" class="form-control" value="{{ $kelompok->jumlah }}" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
    
          <!-- Modal Hapus Data -->
          <div class="modal fade" id="modalHapusData{{ $kelompok->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hapus Kelompok</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/delete-grup-kelompok/{{ $kelompok->id }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $kelompok->id }}">
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong>{{ $kelompok->nama_kelompok }}</strong> ? <br>Data yang dihapus tidak dapat dikembalikan.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        @empty
          <tr>
            <td colspan="5" class="text-center">Belum Ada Data</td>
          </tr>
        @endforelse
      </tbody>
    </table>    
  </div>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalEditTitle">Tambah Grup Kelompok</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="userForm" action="/admin/tambah-grup-kelompok" method="POST">
              @csrf
              <div class="modal-body">
                <div class="row">
                    <div class="mb-3" id="grupSantriContainer">
                      <label for="grup_santri" class="form-label">Rombel</label>
                        <select class="form-select" id="grupSantriSelect" name="grup_santri" required>
                          <option value="">Pilih Rombel</option>
                            @foreach ($grupSantri as $rombel)
                              <option value="{{ $rombel->id }}">{{ $rombel->nama_grup }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="nama_kelompok" for="nama_kelompok">Nama Kelompok</label>
                        <input type="text" class="form-control" id="nama_kelompok" placeholder="Nama Kelompok"
                            name="nama_kelompok" aria-label="Nama Kelompok" required />
                    </div>
                    <div class="mb-3">
                        <label class="jumlah" for="jumlah_kelompok">Jumlah Kelompok</label>
                        <input type="text" class="form-control" id="jumlah" placeholder="Jumlah Kelompok"
                            name="jumlah" aria-label="Jumlah Kelompok" required />
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>

      </div>
  </div>
</div>
@endsection
