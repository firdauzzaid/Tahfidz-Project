@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Grup Cabang')

@section('content')
@include('partials.alerts')

<div class="card">
  <div class="card-header d-flex flex-row justify-content-between align-items-center border-bottom">
      <h5 class="card-title mb-0">Kelola Kelas</h5>
      <div class="demo-inline-spacing">
          <button href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahData"
              class="btn btn-sm btn-primary"><i class="ti ti-category me-2"></i>Tambah Kelas</button>
      </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">Nama Kelas</th>
          <th class="text-center">Alamat Kelas</th>
          <th class="text-center">Dibuat Pada</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($grupCabang as $index => $grup)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td class="text-center">{{ $grup->nama_grup }}</td>
            <td class="text-center">{{ $grup->alamat_grup }}</td>
            <td class="text-center">{{ $grup->created_at }}</td>
            <td>
              <div class="d-flex flex-row justify-content-center align-items-center">
                <!-- Button Edit -->
                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" 
                        data-bs-target="#modalEditData{{ $grup->id }}">
                  <i class="ti ti-edit me-2"></i>Edit
                </button>
                <!-- Button Delete -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                        data-bs-target="#modalHapusData{{ $grup->id }}">
                  <i class="ti ti-trash me-2"></i>Hapus
                </button>
              </div>
            </td>
          </tr>
    
          <!-- Modal Edit Data -->
          <div class="modal fade" id="modalEditData{{ $grup->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Kelas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/edit-grup-cabang/{{ $grup->id }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $grup->id }}">
                    <div class="mb-3">
                      <label for="nama_grup" class="form-label">Nama Kelas</label>
                      <input type="text" name="nama_grup" class="form-control" value="{{ $grup->nama_grup }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="alamat_grup" class="form-label">Alamat Kelas</label>
                      <input type="text" name="alamat_grup" class="form-control" value="{{ $grup->alamat_grup }}" required>
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
          <div class="modal fade" id="modalHapusData{{ $grup->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Hapus Grup</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/delete-grup-cabang/{{ $grup->id }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $grup->id }}">
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong>{{ $grup->nama_grup }}</strong> ? <br>Data yang dihapus tidak dapat dikembalikan.</p>
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
              <h5 class="modal-title" id="modalEditTitle">Tambah Kelas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="userForm" action="/admin/tambah-grup-cabang" method="POST">
              @csrf
              <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <label class="nama_grup" for="nama_grup">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_grup" placeholder="Nama Kelas"
                            name="nama_grup" aria-label="Nama Kelas" required />
                    </div>
                    <div class="mb-3">
                        <label class="alamat_grup" for="alamat_grup">Alamat Kelas</label>
                        <input type="text" class="form-control" id="alamat_grup" placeholder="Alamat Kelas"
                            name="alamat_grup" aria-label="Alamat Kelas" required />
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
