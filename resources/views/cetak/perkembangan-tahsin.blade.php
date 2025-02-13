@php
    $customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Perkembangan Tahsin')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/charts-apex.js'])
@endsection

@section('content')
    @include('partials.alerts')

    <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('cetak.perkembangan-tahsin') }}">
                                <div class="row">
                                    <!-- Pilih Bulan -->
                                    <div class="col-md-4">
                                        <select name="bulan" class="form-select">
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                                                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <!-- Pilih Minggu -->
                                    <div class="col-md-4">
                                        <select name="minggu" class="form-select">
                                            <option value="1" {{ request('minggu') == 1 ? 'selected' : '' }}>Minggu Pertama</option>
                                            <option value="2" {{ request('minggu') == 2 ? 'selected' : '' }}>Minggu Kedua</option>
                                            <option value="3" {{ request('minggu') == 3 ? 'selected' : '' }}>Minggu Ketiga</option>
                                            <option value="4" {{ request('minggu') == 4 ? 'selected' : '' }}>Minggu Keempat</option>
                                        </select>
                                    </div>
                    
                                    <!-- Pilih Tahun -->
                                    <div class="col-md-4">
                                        <input type="number" name="tahun" class="form-control" placeholder="Tahun (contoh: 2023)" value="{{ request('tahun') ?? date('Y') }}">
                                    </div>
                    
                                    <!-- Tombol Submit -->
                                    <div class="col-md-12 mt-3 text-end">
                                        <button type="submit" class="btn btn-primary">Terapkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>                    
                    </div>
                </div>
            </div>
            
            <div class="mb-3 d-flex flex-row justify-content-center align-items-center">
                <button onclick="printCetakData()" class="btn btn-success">Cetak</button>
            </div>

            <div id="cetakData" class="card">
                <h3 class="p-3" style="text-align:center;">Laporan Perkembangan Tahsin</h3>
                <div class="card-body mt-0 pt-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Santri</th>
                                    <th class="text-center">Nama Guru</th>
                                    <th class="text-center">Jilid</th>
                                    <th class="text-center">Halaman</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($data as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $item->nama_santri }}</td>
                                        <td class="text-center">{{ $item->nama_guru }}</td>
                                        <td class="text-center">{{ $item->jilid }}</td>
                                        <td class="text-center">{{ $item->halaman }}</td>
                                        <td class="text-center">{{ $item->tanggal }}</td>
                                        <td class="text-center">{{ $item->keterangan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function printCetakData() {
            // Ambil elemen dengan id "cetakData"
            var cetakElement = document.getElementById('cetakData');
    
            // Buat jendela baru untuk mencetak
            var printWindow = window.open('', '', 'height=600,width=800');
    
            // Salin konten elemen ke dalam jendela baru
            printWindow.document.write('<html><head><title>Laporan Perkembangan Tahsin</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(`
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                th, td {
                    border: 1px solid #333;
                    padding: 8px;
                    text-align: center;
                }
                th {
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                tr:hover {
                    background-color: #f1f1f1;
                }
            `);
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(cetakElement.outerHTML);
            printWindow.document.write('</body></html>');
    
            // Tunggu hingga konten selesai dimuat
            printWindow.document.close();
            printWindow.focus();
    
            // Jalankan print
            printWindow.print();
    
            // Tutup jendela setelah mencetak
            printWindow.close();
        }
    </script>


@endsection
