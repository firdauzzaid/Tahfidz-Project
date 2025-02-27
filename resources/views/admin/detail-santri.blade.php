@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Detail Santri')

@section('vendor-script')
    @vite('resources/assets/vendor/libs/masonry/masonry.js')
@endsection

@section('content')
    <div class="col-12 mb-6">
        <a href="{{ route('admin.kelola-santri') }}" class="btn btn-primary me-4"><i class="ti ti-arrow-back-up me-2"></i>
            Kembali</a>
    </div>
    @include('partials.alerts')
    <div class="col-12 card mb-6">
        <div class="card-body pb-0">
            <div class="d-flex justify-content-start">
                <a href="javascript:;" class="btn btn-primary me-4 mb-4 mr-2" data-bs-target="#modalEditGuru"
                    data-bs-toggle="modal"><i class="ti ti-edit me-2"></i>Edit Detail Santri</a>
                <a href="/sertifikat/{{ $detailSantri->id }}" class="btn btn-primary me-4 mb-4" ><i class="ti ti-certificate me-2"></i>Sertifikat</a>
            </div>
            <div class="row">
                <div class="row">
                    <!-- Detail Data Santri -->
                    <div class="col-12 col-lg-6">
                        <div class="info-container">
                            <h5 class="fw-bold">Detail Data Santri</h5>
                            <ul class="list-unstyled mb-6">
                                <li class="mb-2">
                                    <span class="h6">Nama Lengkap:</span>
                                    <span>{{ $detailSantri->nama_lengkap ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">No Identitas:</span>
                                    <span>{{ $detailSantri->no_identitas ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Alamat:</span>
                                    <span>{{ $detailSantri->alamat ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Tanggal Lahir:</span>
                                    <span>{{ $detailSantri->tgl_lahir ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Jenis Kelamin:</span>
                                    <span>{{ $detailSantri->jenis_kelamin ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Grup Cabang:</span>
                                    <span>{{ $detailSantri->nama_grup_cabang ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Alamat Grup Cabang:</span>
                                    <span>{{ $detailSantri->alamat_grup_cabang ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Grup Santri:</span>
                                    <span>{{ $detailSantri->nama_grup_santri ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Jumlah Maksimal Grup Santri:</span>
                                    <span>{{ $detailSantri->jumlah_maksimal_grup_santri ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Status:</span>
                                    <span>{{ $detailSantri->status == 0 ? 'Aktif' : 'Lulus' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Dibuat Pada:</span>
                                    <span>{{ $detailSantri->created_at ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Diupdate Pada:</span>
                                    <span>{{ $detailSantri->updated_at ?? '-' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Detail Data Wali Santri -->
                    <div class="col-12 col-lg-6">
                        <div class="info-container">
                            <h5 class="fw-bold">Detail Data Wali Santri</h5>

                            <!-- Data Wali Ayah -->
                            <h6 class="fw-bold">Wali Ayah</h6>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <span class="h6">Username:</span>
                                    <span>{{ $waliAyah->no_identitas ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Nama Ayah:</span>
                                    <span>{{ $waliAyah->nama_wali ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Telepon:</span>
                                    <span>{{ $waliAyah->telepon ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Alamat:</span>
                                    <span>{{ $waliAyah->alamat ?? '-' }}</span>
                                </li>
                            </ul>

                            <!-- Data Wali Ibu -->
                            <h6 class="fw-bold">Wali Ibu</h6>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <span class="h6">Username:</span>
                                    <span>{{ $waliIbu->no_identitas ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Nama Wali Ibu:</span>
                                    <span>{{ $waliIbu->nama_wali ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Telepon:</span>
                                    <span>{{ $waliIbu->telepon ?? '-' }}</span>
                                </li>
                                <li class="mb-2">
                                    <span class="h6">Alamat:</span>
                                    <span>{{ $waliIbu->alamat ?? '-' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal Edit Santri -->
    <div class="modal fade" id="modalEditGuru" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Edit Detail Santri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="userForm" action="/admin/edit-data-santri/{{ $detailSantri->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $detailSantri->id }}">
                    <div class="modal-body">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="data-santri-tab" data-bs-toggle="tab"
                                    data-bs-target="#data-santri" type="button" role="tab" aria-controls="data-santri"
                                    aria-selected="true">
                                    Data Santri
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="data-wali-tab" data-bs-toggle="tab"
                                    data-bs-target="#data-wali" type="button" role="tab" aria-controls="data-wali"
                                    aria-selected="false">
                                    Data Wali Santri
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content p-3">
                            <!-- Tab Data Santri -->
                            <div class="tab-pane fade show active" id="data-santri" role="tabpanel" aria-labelledby="data-santri-tab">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="no_identitas" class="form-label">No Identitas</label>
                                        <input type="text" class="form-control" placeholder="No Identitas"
                                            name="no_identitas" value="{{ $detailSantri->no_identitas }}"
                                            aria-label="No Identitas" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_lengkap" class="form-label">Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama"
                                            name="nama_lengkap" value="{{ $detailSantri->nama_lengkap }}"
                                            aria-label="Nama" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                                            value="{{ $detailSantri->alamat }}" aria-label="Alamat" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tgl_lahir"
                                            value="{{ $detailSantri->tgl_lahir }}" aria-label="Tanggal Lahir" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin" required>
                                            <option value="Laki-Laki"
                                                {{ $detailSantri->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                                Laki-Laki</option>
                                            <option value="Perempuan"
                                                {{ $detailSantri->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" placeholder="Keterangan"
                                            name="keterangan" value="{{ $detailSantri->keterangan }}"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="grup_cabang" class="form-label">Kelas</label>
                                        <select class="form-select" name="grup_cabang" required>
                                            @foreach ($grupCabang as $cabang)
                                                <option value="{{ $cabang->id }}"
                                                    {{ $detailSantri->id_grup_cabang == $cabang->id ? 'selected' : '' }}>
                                                    {{ $cabang->nama_grup }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="grup_santri" class="form-label">Rombel</label>
                                        <select class="form-select" name="grup_santri" required>
                                            @foreach ($grupSantri as $santriGroup)
                                                <option value="{{ $santriGroup->id }}"
                                                    {{ $detailSantri->id_grup_santri == $santriGroup->id ? 'selected' : '' }}>
                                                    {{ $santriGroup->nama_grup }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kelompok_quran" class="form-label">Kelompok Qur'an</label>
                                        <select class="form-select" name="kelompok_quran" required>
                                            @foreach ($grupKelompok as $kelompokGroup)
                                                <option value="{{ $kelompokGroup->id }}"
                                                    {{ $detailSantri->id_grup_kelompok == $kelompokGroup->id ? 'selected' : '' }}>
                                                    {{ $kelompokGroup->nama_kelompok }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" required>
                                            <option value="0" {{ $detailSantri->status == 0 ? 'selected' : '' }}>
                                                Aktif</option>
                                            <option value="1" {{ $detailSantri->status == 1 ? 'selected' : '' }}>
                                                Lulus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Data Wali Santri -->
                            <div class="tab-pane fade" id="data-wali" role="tabpanel" aria-labelledby="data-wali-tab">
                                <div class="row">
                                    <h5 class="fw-bold text-center">Wali Santri - Ayah</h5>
                                    <div class="mb-3">
                                        <label for="no_identitas_ayah" class="form-label">No Identitas</label>
                                        <input type="text" class="form-control" placeholder="No Identitas Wali Ayah"
                                            name="no_identitas_ayah" value="{{ $waliAyah->no_identitas }}"
                                            aria-label="No Identitas Wali Ayah" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_wali_ayah" class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="Username Wali"
                                            name="nama_wali_ayah" value="{{ $waliAyah->nama_wali }}"
                                            aria-label="Nama Wali Ayah" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="telepon_wali_ayah" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" placeholder="Telepon Wali"
                                            name="telepon_wali_ayah" value="{{ $waliAyah->telepon }}"
                                            aria-label="Telepon Wali" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat_wali_ayah" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" placeholder="Alamat Wali"
                                            name="alamat_wali_ayah" value="{{ $waliAyah->alamat }}"
                                            aria-label="Alamat Wali" required />
                                    </div>
                                    <h5 class="fw-bold text-center">Wali Santri - Ibu</h5>
                                    <div class="mb-3">
                                        <label for="no_identitas_ibu" class="form-label">No Identitas</label>
                                        <input type="text" class="form-control" placeholder="No Identitas Wali Ibu"
                                            name="no_identitas_ibu" value="{{ $waliIbu->no_identitas }}"
                                            aria-label="No Identitas Wali Ibu" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama_wali_ibu" class="form-label">Username</label>
                                        <input type="text" class="form-control" placeholder="Username Wali"
                                            name="nama_wali_ibu" value="{{ $waliIbu->nama_wali }}"
                                            aria-label="Nama Wali Ibu" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="telepon_wali_ibu" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" placeholder="Telepon Wali"
                                            name="telepon_wali_ibu" value="{{ $waliIbu->telepon }}"
                                            aria-label="Telepon Wali" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat_wali_ibu" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" placeholder="Alamat Wali"
                                            name="alamat_wali_ibu" value="{{ $waliIbu->alamat }}"
                                            aria-label="Alamat Wali" required />
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <button type="button" class="btn btn-label-secondary me-2" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
