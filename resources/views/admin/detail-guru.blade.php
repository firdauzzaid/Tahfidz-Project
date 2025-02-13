@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Detail Guru')

@section('vendor-script')
    @vite('resources/assets/vendor/libs/masonry/masonry.js')
@endsection

@section('content')
    <div class="col-12 mb-6">
        <a href="{{ route('admin.kelola-guru') }}" class="btn btn-primary me-4"><i class="ti ti-arrow-back-up me-2"></i>
            Kembali</a>
    </div>
    @include('partials.alerts')
    <div class="col-12 card mb-6">
        <div class="card-body pb-0">
            <div class="d-flex justify-content-start">
                <a href="javascript:;" class="btn btn-primary me-4 mb-4" data-bs-target="#modalEditGuru"
                    data-bs-toggle="modal"><i class="ti ti-edit me-2"></i>Edit Detail Guru</a>
            </div>
            <div class="row">
                <!-- Foto -->
                <div class="col-12 col-lg-6">
                    <div class="text-center">
                        <img src="{{ $detailGuru['foto'] ? asset('storage/foto-guru/' . $detailGuru['foto']) : 'https://placehold.co/400' }}"
                            alt="Foto Guru" class="img-fluid rounded mb-4" style="max-height: 300px;">
                    </div>
                </div>
                <!-- Detail Data Guru -->
                <div class="col-12 col-lg-6">
                    <div class="info-container">
                        <h5 class="fw-bold">Detail Data Guru</h5>
                        <ul class="list-unstyled mb-6">
                            <li class="mb-2">
                                <span class="h6">Nama:</span>
                                <span>{{ $detailGuru['nama_lengkap'] ?? '-' }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Username:</span>
                                <span>{{ $detailGuru['username'] ?? '-' }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Email:</span>
                                <span>{{ $detailGuru['email'] ?? '-' }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Level:</span>
                                @if ($detailGuru['level'] == 1)
                                    <span class="badge bg-label-primary">Guru</span>
                                @elseif($detailGuru['level'] == 0)
                                    <span class="badge bg-label-success">Admin</span>
                                @else
                                    <span class="badge bg-label-secondary">Unknown</span>
                                @endif
                            </li>
                            <li class="mb-2">
                                <span class="h6">Status:</span>
                                @if ($detailGuru['status'] == 1)
                                    <span class="badge bg-label-primary">Aktif</span>
                                @elseif($detailGuru['status'] == 0)
                                    <span class="badge bg-label-danger">Tidak Aktif</span>
                                @else
                                    <span class="badge bg-label-secondary">Unknown</span>
                                @endif
                            </li>
                            <li class="mb-2">
                                <span class="h6">Lulusan:</span>
                                <span>{{ $detailGuru['lulusan'] ?? '-' }}</span>
                            </li>
                            <li class="mb-2">
                                <span class="h6">Riwayat Mengajar:</span>
                                <span>{{ $detailGuru['riwayat_mengajar'] ?? '-' }}</span>
                            </li>
                            <h3>Grup Cabang</h3>
                            @if (!empty($detailGuru['grup_cabang']))
                                <p><strong>Nama Grup:</strong> {{ $detailGuru['grup_cabang']->nama_grup }}</p>
                                <p><strong>Alamat Grup:</strong> {{ $detailGuru['grup_cabang']->alamat_grup }}</p>
                            @else
                                <p>Data grup cabang tidak tersedia.</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Edit Guru -->
    <div class="modal fade" id="modalEditGuru" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Edit Detail Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="userForm" action="/admin/edit-data-guru" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $detailGuru['id'] }}">
                            <div class="mb-3">
                                <label class="nama" for="nama">Nama</label>
                                <input type="text" class="form-control" value="{{ $detailGuru['nama_lengkap'] ?? '-' }}"
                                    placeholder="Nama" name="nama" aria-label="Nama" required />
                            </div>
                            <div class="mb-3">
                                <label class="username" for="username">Username</label>
                                <input type="text" class="form-control" value="{{ $detailGuru['username'] ?? '-' }}"
                                    placeholder="Username" name="username" aria-label="Username" required />
                            </div>
                            <div class="mb-3">
                                <label class="email" for="email">Email</label>
                                <input type="email" class="form-control" value="{{ $detailGuru['email'] ?? '-' }}"
                                    placeholder="Email" name="email" aria-label="Email" required />
                            </div>
                            <div class="mb-3">
                                <label class="password" for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password"
                                    aria-label="password" />
                                <small class="text-primary">*Abaikan Jika Tidak Ada Perubahan</small>
                            </div>
                            <div class="mb-3">
                                <label class="level" for="level" required>Role</label>
                                <select class="form-select" name="level" required>
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="0" {{ $detailGuru['level'] == 0 ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="1" {{ $detailGuru['level'] == 1 ? 'selected' : '' }}>Guru</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="status" for="status" required>Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="1" {{ $detailGuru['status'] == 1 ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ $detailGuru['status'] == 0 ? 'selected' : '' }}>Tidak Aktif
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="lulusan" for="lulusan">Lulusan</label>
                                <input type="text" class="form-control" value="{{ $detailGuru['lulusan'] ?? '-' }}"
                                    placeholder="Lulusan" name="lulusan" aria-label="Lulusan" required />
                            </div>
                            <div class="mb-3">
                                <div class="mt-3 d-flex justify-content-center align-items-center">
                                    <img id="previewFoto" src="#" alt="Preview Foto"
                                        style="display: none; max-width: 200px; max-height: 200px;" />
                                </div>
                                <label class="foto" for="foto">Foto</label>
                                <input type="file" class="form-control" name="foto" id="foto"
                                    aria-label="Foto" accept="image/*" onchange="previewImage(event)" />
                            </div>
                            <div class="mb-3">
                                <label class="riwayat_mengajar" for="riwayat_mengajar">Riwayat Mengajar</label>
                                <input type="text" class="form-control"
                                    value="{{ $detailGuru['riwayat_mengajar'] ?? '-' }}" placeholder="Riwayat Mengajar"
                                    name="riwayat_mengajar" aria-label="Riwayat Mengajar" required />
                            </div>
                            <div class="mb-3">
                              <label for="grup_cabang" class="form-label">Grup Cabang</label>
                              <select class="form-select" name="grup_cabang" required>
                                  <option value="">Pilih Grup Cabang</option>
                                  @foreach ($grupCabang as $cabang)
                                      <option value="{{ $cabang->id }}"
                                          {{ (isset($detailGuru['grup_cabang']) && $detailGuru['grup_cabang']->id == $cabang->id) ? 'selected' : '' }}>
                                          {{ $cabang->nama_grup }}
                                      </option>
                                  @endforeach
                              </select>
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

    <script>
        function previewImage(event) {
            console.log('Fungsi dipanggil'); // Debugging

            const fotoInput = event.target;
            const preview = document.getElementById('previewFoto');

            // Jika ada file yang diupload
            if (fotoInput.files && fotoInput.files[0]) {
                const file = fotoInput.files[0];

                // Validasi ukuran file (maks 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 5MB.');
                    fotoInput.value = ''; // Reset input
                    preview.style.display = 'none'; // Sembunyikan preview
                    return;
                }

                // Validasi ekstensi file
                const validExtensions = ['image/jpeg', 'image/png', 'image/webp', 'image/heic'];
                if (!validExtensions.includes(file.type)) {
                    alert('Hanya file dengan format jpg, png, webp, atau heic yang diperbolehkan.');
                    fotoInput.value = ''; // Reset input
                    preview.style.display = 'none'; // Sembunyikan preview
                    return;
                }

                // Tampilkan preview gambar
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Tampilkan preview
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none'; // Sembunyikan preview jika tidak ada file
            }
        }
    </script>
@endsection
