
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
    <div class="card-body d-flex flex-col justify-content-center align-items-center">
        <p class="text-center fw-bold">Siswa Tidak Valid/Tidak Terdaftar</p>
    </div>
  </div>
</div>


<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
  // Mengambil elemen dengan ID "qrscan"
  var qrScanElement = document.getElementById('qrscan');

  // Membuat instance QRCode
  var qrcode = new QRCode(qrScanElement, {
    text: 'https://cctoefltest.com/certificate/1', // Menggunakan Blade templating untuk menyisipkan nilai $nilaiPeserta->noreg
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
</script>

@endsection
