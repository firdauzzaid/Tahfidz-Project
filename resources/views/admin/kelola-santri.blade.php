@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Santri')

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
    @vite(['resources/assets/admin/kelola-santri.js'])
@endsection

@section('content')
    @include('partials.alerts')

    <!-- Santri List Table -->
    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0">Kelola Santri</h5>
            <div class="demo-inline-spacing">
                <button href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahData"
                    class="btn btn-sm btn-primary"><i class="ti ti-user-star me-2"></i>Tambah Santri</button>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table-santri table">
                <thead class="border-top">
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Detail</th>
                        <th>No Identitas</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Keterangan</th>
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
                        <h5 class="modal-title" id="modalEditTitle">Tambah Santri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="userForm" action="/santri-list" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="addSantriTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="santri-tab" data-bs-toggle="tab" href="#dataSantri" role="tab">Data Santri</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="data-wali-tab" data-bs-toggle="tab" href="#data-wali-add" role="tab">Data Wali Santri</a>
                                </li>
                            </ul>

                            <div class="tab-content p-3">
                                <!-- Tab Data Santri -->
                                <div class="tab-pane fade show active" id="dataSantri" role="tabpanel" aria-labelledby="santri-tab">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="nama_lengkap" class="form-label">Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama"
                                                name="nama_lengkap" aria-label="Nama" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_identitas" class="form-label">No Identitas</label>
                                            <input type="text" class="form-control" placeholder="No Identitas"
                                                name="no_identitas" aria-label="No Identitas" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                                                aria-label="Alamat" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir"
                                                aria-label="Tanggal Lahir" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" name="jenis_kelamin" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" aria-label="Keterangan" />
                                        </div>
                                        <div class="mb-3" id="grupCabangContainer">
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
                                        </div>
                                        <div class="mb-3" id="grupKelompokQuranContainer">
                                            <label for="grup_kelompok" class="form-label">Kelompok Quran</label>
                                            <select class="form-select" id="grupKelompokQuranSelect" name="grup_kelompok" required>
                                                <option value="">Pilih Kelompok Qur'an</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="0" selected>Aktif</option>
                                                <option value="1">Lulus</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Data Wali Santri -->
                                <div class="tab-pane fade" id="data-wali-add" role="tabpanel"
                                    aria-labelledby="data-wali-tab">
                                    <div class="row">
                                        <h5 class="fw-bold text-center">Wali Santri - Ayah</h5>
                                        <div class="mb-3">
                                            <label for="nama_wali_ayah" class="form-label">Nama Wali Ayah</label>
                                            <input type="text" class="form-control" placeholder="Nama Wali Ayah"
                                                name="nama_wali_ayah" aria-label="Nama Lengkap Ayah" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon_wali_ayah" class="form-label">Telepon Ayah</label>
                                            <input type="number" class="form-control" placeholder="Telepon Ayah"
                                                name="telepon_wali_ayah" aria-label="Telepon Ayah" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_wali_ayah" class="form-label">Alamat Ayah</label>
                                            <input type="text" class="form-control" placeholder="Alamat Ayah"
                                                name="alamat_wali_ayah" aria-label="Alamat Ayah" required />
                                        </div>
                                    
                                        <h5 class="fw-bold text-center">Wali Santri - Ibu</h5>
                                        <div class="mb-3">
                                            <label for="nama_wali_ibu" class="form-label">Nama Wali Ibu</label>
                                            <input type="text" class="form-control" placeholder="Nama Wali Ibu"
                                                name="nama_wali_ibu" aria-label="Nama Ibu" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon_wali_ibu" class="form-label">Telepon Ibu</label>
                                            <input type="number" class="form-control" placeholder="Telepon Ibu"
                                                name="telepon_wali_ibu" aria-label="Telepon Ibu" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_wali_ibu" class="form-label">Alamat Ibu</label>
                                            <input type="text" class="form-control" placeholder="Alamat Ibu"
                                                name="alamat_wali_ibu" aria-label="Alamat Ibu" required />
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

        <!-- Modal Edit Data -->
        <div class="modal fade" id="modalEditData" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditTitle">Edit Santri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="edit-data-user" id="editData" method="POST">
                        <div class="modal-body">
                        @csrf
                        <input type="hidden" id="id" name="id">
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="editSantriTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="data-santri-tab" data-bs-toggle="tab" href="#data-santri-edit" role="tab">Data Santri</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="data-wali-tab" data-bs-toggle="tab" href="#data-wali-edit" role="tab">Data Wali Santri</a>
                                </li>
                            </ul>

                            <div class="tab-content p-3">
                                <!-- Tab Data Santri -->
                                <div class="tab-pane fade show active" id="data-santri-edit" role="tabpanel">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="no_identitas">No Identitas</label>
                                            <input type="text" class="form-control" id="no_identitas" name="no_identitas" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_lengkap">Nama</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option value="">Pilih Salah Satu</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="grup_cabang">Kelas</label>
                                            <select class="form-select" id="grup_cabang" name="grup_cabang" required>
                                                @foreach ($grupCabang as $cabang)
                                                <option value="{{ $cabang->id }}">{{ $cabang->nama_grup }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="grup_santri">Rombel</label>
                                            <select class="form-select" id="grup_santri" name="grup_santri" required>
                                                @foreach ($grupSantri as $santri)
                                                <option value="{{ $santri->id }}">{{ $santri->nama_grup }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelompok_quran">Kelompok Qur'an</label>
                                            <select class="form-select" id="kelompok_quran" name="kelompok_quran" required>
                                                @foreach ($grupKelompok as $kelompok)
                                                <option value="{{ $kelompok->id }}">{{ $kelompok->nama_kelompok }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="0">Aktif</option>
                                                <option value="1">Lulus</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Data Wali Santri -->
                                <div class="tab-pane fade" id="data-wali-edit" role="tabpanel">
                                    <div class="row">
                                        <h5 class="fw-bold text-center">Wali Santri - Ayah</h5>
                                        <div class="mb-3">
                                            <label for="nama_wali_ayah">Nama Wali Ayah</label>
                                            <input type="text" class="form-control" id="nama_wali_ayah" name="nama_wali_ayah" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon_wali_ayah">Telepon Ayah</label>
                                            <input type="number" class="form-control" id="telepon_wali_ayah" name="telepon_wali_ayah" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_wali_ayah">Alamat Ayah</label>
                                            <input type="text" class="form-control" id="alamat_wali_ayah" name="alamat_wali_ayah" required />
                                        </div>

                                        <h5 class="fw-bold text-center">Wali Santri - Ibu</h5>
                                        <div class="mb-3">
                                            <label for="nama_wali_ibu">Nama Wali Ibu</label>
                                            <input type="text" class="form-control" id="nama_wali_ibu" name="nama_wali_ibu" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon_wali_ibu">Telepon Ibu</label>
                                            <input type="number" class="form-control" id="telepon_wali_ibu" name="telepon_wali_ibu" required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_wali_ibu">Alamat Ibu</label>
                                            <input type="text" class="form-control" id="alamat_wali_ibu" name="alamat_wali_ibu" required />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Pilih elemen grup cabang
            const grupCabangContainer = document.getElementById('grupCabangContainer');
            const grupCabangSelect = document.getElementById('grupCabangSelect');

            // Pilih elemen rombel
            const grupSantriContainer = document.getElementById('grupSantriContainer');
            const grupSantriSelect = document.getElementById('grupSantriSelect');

            // Pilih elemen kelompok qur'an
            const grupKelompokQuranContainer = document.getElementById('grupKelompokQuranContainer');
            const grupKelompokQuranSelect = document.getElementById('grupKelompokQuranSelect');

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

            const updateKelompokQuranDropdown = (id_rombel) => {
                if (!id_rombel) {
                    grupKelompokQuranSelect.innerHTML = '<option value="">Pilih Kelompok Qur\'an</option>';
                    return;
                }

                fetch(`/update-kelompok-quran-data/${id_rombel}`, {
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
                        grupKelompokQuranSelect.innerHTML = '<option value="">Pilih Kelompok Qur\'an</option>';

                        if (data.success && Array.isArray(data.kelompok_quran_data) && data.kelompok_quran_data.length > 0) {
                            data.kelompok_quran_data.forEach(kelompok_quran => {
                                grupKelompokQuranSelect.innerHTML += `<option value="${kelompok_quran.id}">${kelompok_quran.nama_kelompok}</option>`;
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching rombel data:", error);
                    });
            };

            grupSantriSelect.addEventListener("change", function () {
                updateKelompokQuranDropdown(this.value);
            });
        });
    </script>
@endsection
