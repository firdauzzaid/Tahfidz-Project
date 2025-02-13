@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Guru')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/animate-css/animate.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/admin/kelola-guru.js'])
@endsection

@section('content')
    @include('partials.alerts')

    <!-- Guru List Table -->
    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0">Kelola Guru</h5>
            <div class="demo-inline-spacing">
                <button href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahData"
                    class="btn btn-sm btn-primary"><i class="ti ti-user-star me-2"></i>Tambah Guru</button>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table-guru table">
                <thead class="border-top">
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Detail</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Bergabung Pada</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
        
        <!-- Modal Tambah Data -->
        <div class="modal fade" id="modalTambahData" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditTitle">Tambah Guru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="userForm" action="/guru-list" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label class="nama_lengkap" for="nama_lengkap">Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama_lengkap"
                                        aria-label="Nama" required />
                                </div>
                                <div class="mb-3">
                                    <label class="username" for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                        aria-label="Username" required />
                                </div>
                                <div class="mb-3">
                                    <label class="email" for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        aria-label="Email" required />
                                </div>
                                <div class="mb-3">
                                    <label class="password" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        aria-label="password" required />
                                </div>
                                <div class="mb-3">
                                    <label class="level" for="level" required>Level</label>
                                    <select class="form-select" id="levelSelect" name="level" required>
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Guru</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="status" for="status" required>Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                
                                <!-- <div class="mb-3" id="grupCabangContainer">
                                    <label for="grup_cabang" class="form-label">Kelas</label>
                                    <select class="form-select" id="grupCabangSelect" name="grup_cabang" required>
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($grupCabang as $cabang)
                                            <option value="{{ $cabang->id }}">{{ $cabang->nama_grup }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3" id="grupSantriContainer">
                                    <label for="grup_santri" class="form-label">Rombel</label>
                                    <select class="form-select" id="grupSantriSelect" name="grup_santri" required>
                                        <option value="">Pilih Rombel</option>
                                    </select>
                                </div> -->
                                
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

        <!-- Modal Edit Data-->
        <div class="modal fade" id="modalEditData" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditTitle">Edit Guru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="edit-data-user" id="editData">
                        <div class="modal-body">
                            <input type="hidden" id="id" name="id" />
                            <div class="row">
                                <div class="mb-3 fieldnya">
                                    <label class="username" for="username">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username"
                                        name="username" aria-label="Username" required />
                                </div>
                                <div class="mb-3 fieldnya">
                                    <label class="nama_lengkap" for="nama_lengkap">Nama</label>
                                    <input type="text" class="form-control" id="nama_lengkap" placeholder="Nama"
                                        name="nama_lengkap" aria-label="Nama" required />
                                </div>
                                <div class="mb-3 fieldnya">
                                    <label class="email" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Email"
                                        name="email" aria-label="Email" required />
                                </div>
                                <div class="mb-3 fieldnya">
                                    <label class="password" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password" aria-label="Password" />
                                    <small class="text-primary">*Abaikan Jika Tidak Ada Perubahan</small>
                                </div>
                                <div class="mb-3 fieldnya">
                                    <label class="level" for="level" required>Level</label>
                                    <select id="level" class="form-select" name="level">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Guru</option>
                                    </select>
                                </div>
                                <div class="mb-3 fieldnya">
                                    <label class="status" for="status" required>Status</label>
                                    <select id="status" class="form-select" name="status">
                                        <option value="">Pilih Salah Satu</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Pilih elemen grup cabang
            const levelSelect = document.getElementById('levelSelect');
            const grupCabangContainer = document.getElementById('grupCabangContainer');
            const grupCabangSelect = document.getElementById('grupCabangSelect');

            // Pilih elemen rombel
            const grupSantriContainer = document.getElementById('grupSantriContainer');
            const grupSantriSelect = document.getElementById('grupSantriSelect');

            // Event Listener untuk mendeteksi perubahan pada dropdown level
            levelSelect.addEventListener('change', function () {
                if (this.value === '0') {
                    // Container Kelas
                    grupCabangContainer.style.display = 'none'; 
                    grupCabangSelect.required = false;
                    // Container Rombel
                    grupSantriContainer.style.display = 'none'; 
                    grupSantriSelect.required = false;
                } else {
                    // Container Kelas
                    grupCabangContainer.style.display = 'block';
                    grupCabangSelect.required = true;
                    // Container Rombel
                    grupSantriContainer.style.display = 'block';
                    grupSantriSelect.required = true;
                }
            });

            const updateRombelDropdown = (id_cabang) => {
                if (!id_cabang) {
                    grupSantriSelect.innerHTML = '<option value="">Pilih Rombel</option>';
                    return;
                }

                fetch(`/update-rombel-data/${id_cabang}`, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        grupSantriSelect.innerHTML = '<option value="">Pilih Rombel</option>';

                        if (data.success && Array.isArray(data.rombel_data) && data.rombel_data.length > 0) {
                            data.rombel_data.forEach(rombel => {
                                grupSantriSelect.innerHTML += `<option value="${rombel.id}">${rombel.nama_grup}</option>`;
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching rombel data:", error);
                    });
            };

            grupCabangSelect.addEventListener("change", function () {
                updateRombelDropdown(this.value);
            });
        });
    </script> -->
@endsection
