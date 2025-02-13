@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Grup Santri')

@section('content')
@include('partials.alerts')

<div class="card">
  <div class="card-header d-flex flex-row justify-content-between align-items-center border-bottom">
      <h5 class="card-title mb-0">Kelola Rombel</h5>
      <div class="demo-inline-spacing">
          <button href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahData"
              class="btn btn-sm btn-primary"><i class="ti ti-category me-2"></i>Tambah Rombel</button>
      </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">Nama Rombel</th>
          <th class="text-center">Jumlah Maksimal</th>
          <th class="text-center">Dibuat Pada</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse ($grupSantri as $index => $grup)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td class="text-center">{{ $grup->nama_grup }}</td>
            <td class="text-center">{{ $grup->jumlah_maksimal }}</td>
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
                  <h5 class="modal-title">Edit Rombel</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/edit-grup-santri/{{ $grup->id }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $grup->id }}">
                      <label for="grup_cabang" class="form-label">Kelas</label>
                        <select class="form-select" id="grupCabangSelect" name="grup_cabang" required>
                            @foreach ($grupCabang as $cabang)
                                <option value="{{ $cabang->id }}" {{ $grup->id_cabang == $cabang->id ? 'selected' : '' }}>
                                    {{ $cabang->nama_grup }}
                                </option>
                            @endforeach
                        </select>
                    <div class="mb-3">
                      <label for="nama_grup" class="form-label">Nama Rombel</label>
                      <input type="text" name="nama_grup" class="form-control" value="{{ $grup->nama_grup }}" required>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_maksimal" class="form-label">Jumlah Maksimal</label>
                      <input type="number" name="jumlah_maksimal" class="form-control" value="{{ $grup->jumlah_maksimal }}" required>
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
                  <h5 class="modal-title">Hapus Rombel</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/delete-grup-santri/{{ $grup->id }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $grup->id }}">
                  <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong>{{ $grup->nama_grup }}</strong> ? <br>Semua data siswa yang ada di dalam grup ini akan terhapus.</p>
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
              <h5 class="modal-title" id="modalEditTitle">Tambah Rombel</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="userForm" action="/admin/tambah-grup-santri" method="POST">
              @csrf
              <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <label for="grup_cabang" class="form-label">Kelas</label>
                        <select class="form-select" id="grupCabangSelect" name="grup_cabang" required>
                            <option value="">Pilih Kelas</option>
                              @foreach ($grupCabang as $cabang)
                                <option value="{{ $cabang->id }}">{{ $cabang->nama_grup }}</option>
                              @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="nama_grup" for="nama_grup">Nama Rombel</label>
                        <input type="text" class="form-control" id="nama_grup" placeholder="Nama Rombel"
                            name="nama_grup" aria-label="Nama Grup" required />
                    </div>
                    <div class="mb-3">
                        <label class="jumlah_maksimal" for="jumlah_maksimal">Jumlah Maksimal</label>
                        <input type="number" class="form-control" id="jumlah_maksimal" placeholder="Jumlah Maksimal"
                            name="jumlah_maksimal" aria-label="Jumlah Maksimal" required />
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
