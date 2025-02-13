@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Kelola Grup Cabang')

<!-- Vendor Styles -->
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

<!-- Page Scripts -->
@section('page-script')
@vite([
  'resources/assets/js/forms-selects.js',
  'resources/assets/js/forms-tagify.js',
  'resources/assets/js/forms-typeahead.js'
])
@endsection

@section('content')
    @include('partials.alerts')
    <style>
        .border-surah {
            display: block;
            border-bottom: 1px solid #e6e6e8;
            padding: 5px 0;
        }
    </style>

    <div class="card">
        <div class="card-header d-flex flex-row justify-content-between align-items-center border-bottom">
            <h5 class="card-title mb-0">Kelola Juz</h5>
            <div class="demo-inline-spacing">
                <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-category me-2"></i> Tambah Data
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahJuz">Tambah Juz</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahLevel">Tambah Level</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalTambahSurah">Tambah Surah</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Modal Tambah Juz -->
        <div class="modal fade" id="modalTambahJuz" tabindex="-1" aria-labelledby="modalTambahJuzLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/admin/tambah-juz" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahJuzLabel">Tambah Juz</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Input Nama Juz -->
                            <div class="mb-3">
                                <label for="select2Juz" class="form-label">Pilih Juz</label>
                                <select id="select2Juz" class="select2 form-select form-select-lg" name="nama_juz[]" multiple required>
                                    <option value="Juz 1">Juz 1</option>
                                    <option value="Juz 2">Juz 2</option>
                                    <option value="Juz 3">Juz 3</option>
                                    <option value="Juz 4">Juz 4</option>
                                    <option value="Juz 5">Juz 5</option>
                                    <option value="Juz 6">Juz 6</option>
                                    <option value="Juz 7">Juz 7</option>
                                    <option value="Juz 8">Juz 8</option>
                                    <option value="Juz 9">Juz 9</option>
                                    <option value="Juz 10">Juz 10</option>
                                    <option value="Juz 11">Juz 11</option>
                                    <option value="Juz 12">Juz 12</option>
                                    <option value="Juz 13">Juz 13</option>
                                    <option value="Juz 14">Juz 14</option>
                                    <option value="Juz 15">Juz 15</option>
                                    <option value="Juz 16">Juz 16</option>
                                    <option value="Juz 17">Juz 17</option>
                                    <option value="Juz 18">Juz 18</option>
                                    <option value="Juz 19">Juz 19</option>
                                    <option value="Juz 20">Juz 20</option>
                                    <option value="Juz 21">Juz 21</option>
                                    <option value="Juz 22">Juz 22</option>
                                    <option value="Juz 23">Juz 23</option>
                                    <option value="Juz 24">Juz 24</option>
                                    <option value="Juz 25">Juz 25</option>
                                    <option value="Juz 26">Juz 26</option>
                                    <option value="Juz 27">Juz 27</option>
                                    <option value="Juz 28">Juz 28</option>
                                    <option value="Juz 29">Juz 29</option>
                                    <option value="Juz 30" selected>Juz 30</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah Juz</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Tambah Level -->
        <div class="modal fade" id="modalTambahLevel" tabindex="-1" aria-labelledby="modalTambahLevelLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/admin/tambah-juz-level" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahLevelLabel">Tambah Level</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Pilih Juz -->
                            <div class="mb-3">
                                <label for="select2JuzLevel" class="form-label">Pilih Juz</label>
                                <select id="select2JuzLevel" class="select2 form-select form-select-lg" name="id_juz[]" multiple required>
                                    @foreach ($juz as $item)
                                        <option value="{{ $item->id }}" selected>{{ $item->juz }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Input Nama Level -->
                            <div class="mb-3">
                                <label for="select2Level" class="form-label">Nama Level</label>
                                <select id="select2Level" class="select2 form-select form-select-lg" name="level[]" multiple required>
                                     <option value="1" selected>1</option>
                                     <option value="3/4" selected>3/4</option>
                                     <option value="1/2" selected>1/2</option>
                                     <option value="1/4" selected>1/4</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah Level</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Tambah Surah -->
        <div class="modal fade" id="modalTambahSurah" tabindex="-1" aria-labelledby="modalTambahSurahLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/admin/tambah-juz-surat" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahSurahLabel">Tambah Surah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Pilih Juz -->
                            <div class="mb-3">
                                <label for="id_juzSurah" class="form-label">Pilih Juz</label>
                                <select id="id_juzSurah" class="form-select" name="id_juz" required>
                                    <option value="" disabled selected>Pilih Juz</option>
                                    @foreach ($juz as $item)
                                        <option value="{{ $item->id }}">{{ $item->juz }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Level -->
                            <div class="mb-3" id="field-level" style="display: none;">
                                <label for="id_juz_levelSurah" class="form-label">Pilih Level</label>
                                <select id="id_juz_levelSurah" class="form-select" name="id_juz_level" required>
                                    <option value="" disabled selected>Pilih Level</option>
                                    <!-- Level akan dimuat dengan AJAX -->
                                </select>
                            </div>

                            <!-- Input Nama Surah -->
                            <div class="mb-3" id="field-surah" style="display: none;">
                                <label for="select2Multiple" class="form-label">Nama Surah</label>
                                <select class="select2 form-select form-select-lg" name="nama_surat[]" id="select2Multiple" multiple required>
                                    <option value="">Pilih Surah</option>
                                    <option value="Al-Fatihah">Al-Fatihah</option>
                                    <option value="Al-Baqarah">Al-Baqarah</option>
                                    <option value="Aali Imran">Aali Imran</option>
                                    <option value="An-Nisa">An-Nisa</option>
                                    <option value="Al-Ma'idah">Al-Ma'idah</option>
                                    <option value="Al-An'am">Al-An'am</option>
                                    <option value="Al-A'raf">Al-A'raf</option>
                                    <option value="Al-Anfal">Al-Anfal</option>
                                    <option value="At-Tawbah">At-Tawbah</option>
                                    <option value="Yunus">Yunus</option>
                                    <option value="Hud">Hud</option>
                                    <option value="Yusuf">Yusuf</option>
                                    <option value="Ibrahim">Ibrahim</option>
                                    <option value="Al-Hijr">Al-Hijr</option>
                                    <option value="An-Nahl">An-Nahl</option>
                                    <option value="Al-Isra">Al-Isra</option>
                                    <option value="Al-Kahf">Al-Kahf</option>
                                    <option value="Maryam">Maryam</option>
                                    <option value="Taha">Taha</option>
                                    <option value="Al-Anbiya">Al-Anbiya</option>
                                    <option value="Al-Hajj">Al-Hajj</option>
                                    <option value="Al-Mu'minun">Al-Mu'minun</option>
                                    <option value="An-Nur">An-Nur</option>
                                    <option value="Al-Furqan">Al-Furqan</option>
                                    <option value="Ash-Shu'ara">Ash-Shu'ara</option>
                                    <option value="An-Naml">An-Naml</option>
                                    <option value="Al-Ankabut">Al-Ankabut</option>
                                    <option value="Ar-Rum">Ar-Rum</option>
                                    <option value="Luqman">Luqman</option>
                                    <option value="As-Sajda">As-Sajda</option>
                                    <option value="Al-Ahzab">Al-Ahzab</option>
                                    <option value="Ya-Sin">Ya-Sin</option>
                                    <option value="Az-Zumar">Az-Zumar</option>
                                    <option value="Fussilat">Fussilat</option>
                                    <option value="Al-Ahqaf">Al-Ahqaf</option>
                                    <option value="Muhammad">Muhammad</option>
                                    <option value="Al-Fath">Al-Fath</option>
                                    <option value="Al-Hujurat">Al-Hujurat</option>
                                    <option value="Qaf">Qaf</option>
                                    <option value="Az-Zariyat">Az-Zariyat</option>
                                    <option value="Al-Hadid">Al-Hadid</option>
                                    <option value="Al-Mujadila">Al-Mujadila</option>
                                    <option value="Al-Hashr">Al-Hashr</option>
                                    <option value="Al-Mumtahanah">Al-Mumtahanah</option>
                                    <option value="As-Saff">As-Saff</option>
                                    <option value="Al-Jumu'ah">Al-Jumu'ah</option>
                                    <option value="Al-Munafiqun">Al-Munafiqun</option>
                                    <option value="At-Taghabun">At-Taghabun</option>
                                    <option value="At-Talaq">At-Talaq</option>
                                    <option value="At-Tahrim">At-Tahrim</option>
                                    <option value="Al-Mulk">Al-Mulk</option>
                                    <option value="Al-Qalam">Al-Qalam</option>
                                    <option value="Al-Haqqah">Al-Haqqah</option>
                                    <option value="Al-Ma'arij">Al-Ma'arij</option>
                                    <option value="Nuh">Nuh</option>
                                    <option value="Al-Jinn">Al-Jinn</option>
                                    <option value="Al-Muzzammil">Al-Muzzammil</option>
                                    <option value="Al-Muddatir">Al-Muddatir</option>
                                    <option value="Al-Qiyama">Al-Qiyama</option>
                                    <option value="Al-Insan">Al-Insan</option>
                                    <option value="Al-Mursalat">Al-Mursalat</option>
                                    <option value="An-Naba">An-Naba</option>
                                    <option value="An-Nazi'at">An-Nazi'at</option>
                                    <option value="Abasa">Abasa</option>
                                    <option value="At-Takwir">At-Takwir</option>
                                    <option value="Al-Infitar">Al-Infitar</option>
                                    <option value="Al-Mutaffifin">Al-Mutaffifin</option>
                                    <option value="Al-Inshiqaq">Al-Inshiqaq</option>
                                    <option value="Al-Buruj">Al-Buruj</option>
                                    <option value="At-Tariq">At-Tariq</option>
                                    <option value="Al-A'la">Al-A'la</option>
                                    <option value="Al-Ghashiya">Al-Ghashiya</option>
                                    <option value="Al-Fajr">Al-Fajr</option>
                                    <option value="Al-Balad">Al-Balad</option>
                                    <option value="Ash-Shams">Ash-Shams</option>
                                    <option value="Al-Lail">Al-Lail</option>
                                    <option value="Ad-Duha">Ad-Duha</option>
                                    <option value="Al-Inshirah">Al-Inshirah</option>
                                    <option value="At-Tin">At-Tin</option>
                                    <option value="Al-Alaq">Al-Alaq</option>
                                    <option value="Al-Qadr">Al-Qadr</option>
                                    <option value="Al-Bayyina">Al-Bayyina</option>
                                    <option value="Az-Zalzalah">Az-Zalzalah</option>
                                    <option value="Al-Adiyat">Al-Adiyat</option>
                                    <option value="Al-Qari'ah">Al-Qari'ah</option>
                                    <option value="At-Takathur">At-Takathur</option>
                                    <option value="Al-Asr">Al-Asr</option>
                                    <option value="Al-Humazah">Al-Humazah</option>
                                    <option value="Al-Fil">Al-Fil</option>
                                    <option value="Quraish">Quraish</option>
                                    <option value="Al-Ma'un">Al-Ma'un</option>
                                    <option value="Al-Kawthar">Al-Kawthar</option>
                                    <option value="Al-Kafirun">Al-Kafirun</option>
                                    <option value="An-Nasr">An-Nasr</option>
                                    <option value="Al-Masad">Al-Masad</option>
                                    <option value="Al-Ikhlas">Al-Ikhlas</option>
                                    <option value="Al-Falaq">Al-Falaq</option>
                                    <option value="An-Nas">An-Nas</option>
                                </select>
                                <small class="text-muted">Pilih salah satu surah yang ada dalam Al-Qur'an.</small>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah Surah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
          <table class="table">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Juz</th>
                      <th>Level</th>
                      <th>Daftar Surah</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($data as $juz)
                      @foreach ($juz as $index => $level)
                          <tr>
                              @if ($index === 0)
                                  <td rowspan="{{ count($juz) }}">{{ $loop->parent->iteration }}</td>
                                  <td rowspan="{{ count($juz) }}">{{ $level->nama_juz }}</td>
                              @endif
                              <td>{{ $level->level_name }}</td>
                              <td>
                                  <ul>
                                      @foreach (explode(', ', $level->surahs) as $surah)
                                          <li>{{ $surah }}</li>
                                      @endforeach
                                  </ul>
                              </td>
                              @if ($index === 0)
                                <td rowspan="{{ count($juz) }}">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <form action="/admin/hapus-juz/{{ $level->juz_id }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="ti ti-trash mr-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                              @endif
                          </tr>
                      @endforeach
                  @endforeach
              </tbody>
          </table>
      </div>
      
      
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
          const selectJuz = document.getElementById('id_juzSurah');
          const selectLevel = document.getElementById('id_juz_levelSurah');
          const fieldLevel = document.getElementById('field-level');
          const fieldSurah = document.getElementById('field-surah');

          // Event listener untuk dropdown Juz
          selectJuz.addEventListener('change', function () {
              const juzId = this.value;

              // Reset Level dan Nama Surah
              fieldLevel.style.display = 'none';
              fieldSurah.style.display = 'none';
              selectLevel.innerHTML = '<option value="" disabled selected>Memuat Level...</option>';

              // Fetch data Level jika Juz dipilih
              if (juzId) {
                  fetch(`/admin/get-levels/${juzId}`)
                      .then(response => response.json())
                      .then(data => {
                          // Populate Level dropdown
                          selectLevel.innerHTML = '<option value="" disabled selected>Pilih Level</option>';
                          data.forEach(level => {
                              const option = document.createElement('option');
                              option.value = level.id;
                              option.textContent = level.level;
                              selectLevel.appendChild(option);
                          });

                          // Tampilkan field Level
                          fieldLevel.style.display = 'block';
                      })
                      .catch(error => {
                          console.error('Error fetching levels:', error);
                      });
              }
          });

          // Event listener untuk dropdown Level
          selectLevel.addEventListener('change', function () {
              // Tampilkan field Nama Surah hanya jika Level dipilih
              if (this.value) {
                  fieldSurah.style.display = 'block';
              } else {
                  fieldSurah.style.display = 'none';
              }
          });
      });
    </script>
@endsection
