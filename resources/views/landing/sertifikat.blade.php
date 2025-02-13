
@php
$configData = Helper::appClasses();
$isMenu = false;
$isNavbar = false;
$navbarHideToggle = false;
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Sertifikat')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-help-center.css')}}" />
@endsection

<style>
.container-xxl, .flex-grow-1, .container-p-y {
  width: auto!important;
}
</style>

@section('content')

<div id="cetakSertifikat" class="row">
  <div class="card bg-transparent shadow-none">
    <div class="card-body">
      <div class="d-flex justify-content-center">
        <img src="{{asset('assets/img/home/sertifikat-kelulusan.png')}}" alt="" width="800">
          <div class="judul" style="position: absolute;top: 182px;color:black;font-size:15px;font-weight:900;margin-left:2px;">
            <p>No {{$santri->no_identitas}}</p>
          </div>
          <div class="judul" style="position: absolute;top: 245px;color:black;font-size:45px;font-weight:900;margin-left:18px;">
            <p>{{$santri->nama_lengkap}}</p>
          </div>
          <!--<div class="judul" style="position: absolute;top: 300px;color:black;font-size:15px;font-weight:900;margin-left:18px;">-->
          <!--  <p>Binti {{$wali->nama_wali ?? '-'}}</p>-->
          <!--</div>-->
          <!--<div id="qrscan" style="position: absolute;top: 25em;margin-right: 4em;"></div>-->
      </div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="d-flex justify-content-center">
    <button class="btn btn-primary me-2" onclick="downloadPDF('{{$santri->no_identitas}}')"><i class="bx bxs-file-pdf me-2"></i>Unduh PDF</button>
    <button class="btn btn-primary" onclick="downloadPNG('{{$santri->no_identitas}}')"><i class="bx bxs-image me-2"></i>Download PNG</button>
  </div>
</div>

@foreach($nilaiTasmi as $nilai)
<div id="cetakSertifikatJuz{{ $nilai->juz }}" class="row">
  <div class="card bg-transparent shadow-none">
    <div class="card-body">
      <div class="d-flex justify-content-center">
        <img src="{{ asset('assets/img/home/sertifikat-penilaian.png') }}" alt="" width="800">
        <div class="judul" style="position: absolute; top: 182px; color:black; font-size:15px; font-weight:900; margin-left:2px;">
          <p>No {{ $santri->no_identitas }}</p>
        </div>
        
          <div class="judul" style="position: absolute; top: 225px; color:black; font-size:45px; font-weight:900; margin-left:18px;">
            <p>Penilaian Juz {{ $nilai->juz }}</p>
          </div>
          <div style="position: absolute; top: 375px;margin-left:-252px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->tajwid1 }}</p>
          </div>
          <div style="position: absolute; top: 417px;margin-left:-252px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->tajwid2 }}</p>
          </div>
          <div style="position: absolute; top: 459px;margin-left:-252px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->tajwid3 }}</p>
          </div>
          <div style="position: absolute; top: 495px;margin-left:-252px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->tajwid4 }}</p>
          </div>
          <div style="position: absolute; top: 375px;margin-right:-633px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->fashohah1 }}</p>
          </div>
          <div style="position: absolute; top: 417px;margin-right:-633px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->fashohah2 }}</p>
          </div>
          <div style="position: absolute; top: 459px;margin-right:-633px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->fashohah3 }}</p>
          </div>
          <div style="position: absolute; top: 495px;margin-right:-633px; color:black; font-size:15px; font-weight:900;">
            <p>{{ $nilai->fashohah4 }}</p>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="d-flex justify-content-center">
    <button class="btn btn-primary me-2" onclick="downloadPDFJuz({{ $nilai->juz }})">
      <i class="bx bxs-file-pdf me-2"></i>Unduh PDF Juz {{ $nilai->juz }}
    </button>
    <button class="btn btn-primary" onclick="downloadPNGJuz({{ $nilai->juz }})">
      <i class="bx bxs-image me-2"></i>Download PNG Juz {{ $nilai->juz }}
    </button>
  </div>
</div>

@endforeach


<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
  // Mengambil elemen dengan ID "qrscan"
  var qrScanElement = document.getElementById('qrscan');

  // Membuat instance QRCode
  var qrcode = new QRCode(qrScanElement, {
    text: 'https://app.yayasantsabata.com/sertifikat/{{$santri->no_identitas}}', // Menggunakan Blade templating untuk menyisipkan nilai $nilaiPeserta->noreg
    width: 90,
    height: 90
  });
</script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
  function downloadPDF(noreg) {
    // Mengambil elemen dengan ID "cetakSertifikat" sebagai gambar PNG
    html2canvas(document.getElementById('cetakSertifikat'), { scale: 3, margin: 0 }).then(function(canvas) {
      var imgData = canvas.toDataURL('image/png');

      // Membuat dokumen PDF menggunakan pdfmake.js
      var docDefinition = {
        content: [
          {
            image: imgData,
            width: 920.28, // lebar halaman A4 dalam satuan pixel
            height: 652.89, // tinggi halaman A4 dalam satuan pixel
            margin: [0, 0, 0, 0],
          }
        ],
        pageSize: 'A4',
        pageOrientation: 'landscape', // Menentukan orientasi landscape
        pageMargins: [-40, -30, 0, 0] 
      };

      // Menggunakan nama lengkap sebagai nama file PDF
      pdfMake.createPdf(docDefinition).download('sertifikat-' + noreg + '.pdf');
    });
  }
  function downloadPNG(noreg) {
    // Mengambil elemen dengan ID "cetakSertifikat" sebagai gambar PNG
    html2canvas(document.getElementById('cetakSertifikat'), { scale: 3 }).then(function(canvas) {
      var imgData = canvas.toDataURL('image/png');

      // Buat tautan unduhan untuk gambar PNG
      var a = document.createElement('a');
      a.href = imgData;
      a.download = 'sertifikat-' + noreg + '.png';
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    });
  }
  function downloadPDFJuz(juz) {
      html2canvas(document.getElementById('cetakSertifikatJuz' + juz), { scale: 3 }).then(function(canvas) {
        var imgData = canvas.toDataURL('image/png');
    
        var docDefinition = {
          content: [
            {
              image: imgData,
              fit: [800, 600]
            }
          ],
          pageSize: 'A4',
          pageOrientation: 'landscape',
          pageMargins: [10, 10, 10, 10]
        };
    
        pdfMake.createPdf(docDefinition).download('sertifikat-juz-' + juz + '.pdf');
      });
    }
    
    function downloadPNGJuz(juz) {
      html2canvas(document.getElementById('cetakSertifikatJuz' + juz), { scale: 3 }).then(function(canvas) {
        var imgData = canvas.toDataURL('image/png');
    
        var a = document.createElement('a');
        a.href = imgData;
        a.download = 'sertifikat-juz-' + juz + '.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      });
    }

</script>

@endsection
