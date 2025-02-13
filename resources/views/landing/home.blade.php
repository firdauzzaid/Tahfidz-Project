<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <!-- Meta untuk SEO -->
    <meta name="description"
        content="Lembaga pendidikan yang
                berfokus pada pengajaran Al-Qur'an dan akhlak.">
    <meta name="keywords" content="tsabata, pendidikan quran, hafalan quran, khataman quran">
    <meta name="author" content="Tsabata">
    <link rel="canonical" href="https://www.domainanda.com/tentang-kami" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body>
    <!-- Navbar -->
    <nav
        class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Tsabata</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="/auth/login"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">LOGIN</a>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#home"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white">Home</a>
                    </li>
                    <li>
                        <a href="#tentang"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white">Tentang
                            Kami</a>
                    </li>
                    <li>
                        <a href="#visi-misi"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white">Visi
                            & Misi</a>
                    </li>
                    <li>
                        <a href="#galeri"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white">Galeri</a>
                    </li>
                    <li>
                        <a href="#kontak"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white">Kontak
                            Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home"
        class="bg-center bg-no-repeat bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/conference.jpg')] bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                Selamat Datang di RTQ TSABATA</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Lembaga pendidikan yang
                berfokus pada pengajaran Al-Qur'an dan akhlak.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="/auth/login"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Login
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                <a href="#tentang"
                    class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                    Tentang Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Tentang Kami</h2>
            <p class="text-lg text-gray-700 leading-8 text-justify">
                Untuk membentuk generasi berjiwa Al-Qur’an harus di mulai dengan mempelajari cara membaca
                Al-Qur’an yang baik dan benar sesuai kaidah ilmu tajwid, namun kenyataan yang didapati bahwa
                belum banyak yang ikut berkecimpung dalam pendidikan tahsin dan tahfidz Al-Qur’an lantaran
                terkendala dengan berbagai hal yang bersifat intern maupun ekstern, maka kami merasa terpanggil
                untuk ikut terlibat di dalamnya.
            </p>
            <p class="text-lg text-gray-700 leading-8 text-justify mt-4">
                Oleh sebab itu kami termotivasi untuk mendirikan Rumah Tahfidz Qur’an Tsabata (RTQ-Tsabata)
                dan Pendidikan Anak Usia Dini Qur’an untuk memasyarakatkan Al-Qur’an kepada generasi penerus
                agar terbebas dari buta huruf Al-Qur’an serta menumbuhkan kecintaan terhadap membaca Al-Qur’an
                juga menumbuhkan semangat dalam menghapal Al-Qur’an sehingga Al-Qur’an dapat terus terjaga
                kelestariannya.
            </p>
        </div>
    </section>

    <!-- Visi & Misi Section -->
    <section id="visi-misi" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Visi & Misi Program</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Visi Card -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-blue-600 mb-4">Visi</h3>
                    <p class="text-gray-700 leading-7">
                        Menjadi lembaga pendidikan Al-Qur’an yang dapat membentuk generasi penerus yang gemar
                        membaca dan menghapal Al-Qur’an sesuai dengan kaidah ilmu tajwid serta mampu
                        mengamalkan Al-Qur’an dalam kehidupan sehari-hari.
                    </p>
                </div>

                <!-- Misi Card -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-2xl font-bold text-blue-600 mb-4">Misi</h3>
                    <ul class="list-disc list-inside text-gray-700 leading-7">
                        <li>Memberikan pengetahuan mengenai adab terhadap Al-Qur’an</li>
                        <li>Memberikan pengetahuan mengenai adab terhadap guru Al-Qur’an</li>
                        <li>Memberikan paradigma mengenai keutamaan menghapal Al-Qur’an</li>
                        <li>Mengembangkan kebiasaan membaca Al-Qur’an sesuai kaidah tajwid</li>
                        <li>Membiasakan mengamalkan Al-Qur’an dalam kehidupan sehari-hari</li>
                        <li>Menyelenggarakan sistem layanan hafalan Al-Qur’an yang komprehensif</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Memilih RTQ TSABATA -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Mengapa Memilih RTQ TSABATA?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-blue-600 mb-4">Guru Berpengalaman</h3>
                    <p class="text-gray-700">Diajarkan oleh guru dengan latar belakang pendidikan formal dan pengalaman
                        mengajar yang memadai.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-blue-600 mb-4">Fasilitas Modern</h3>
                    <p class="text-gray-700">Ruang kelas ber-AC dan akses Wi-Fi untuk mendukung proses belajar.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-blue-600 mb-4">Metode TILAWATI</h3>
                    <p class="text-gray-700">Pendekatan pembelajaran yang menyenangkan dan efektif.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-blue-600 mb-4">Pembekalan Akidah</h3>
                    <p class="text-gray-700">Menanamkan nilai-nilai akidah yang baik kepada santri.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-bold text-blue-600 mb-4">Tanpa Biaya Gedung</h3>
                    <p class="text-gray-700">Kami tidak membebankan biaya gedung kepada santri.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Materi Pembelajaran -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Materi Pembelajaran</h2>
            <ul class="list-disc list-inside text-gray-700 text-lg leading-8">
                <li><span class="font-bold">Tahsin:</span> Memperbaiki bacaan Al-Qur'an.</li>
                <li><span class="font-bold">Tafidz:</span> Menghafal Al-Qur'an.</li>
                <li><span class="font-bold">Kitabah:</span> Pembelajaran menulis.</li>
                <li><span class="font-bold">Maulid:</span> Memperkenalkan sejarah dan nilai-nilai Islam.</li>
                <li><span class="font-bold">Fiqh:</span> Memahami hukum-hukum Islam.</li>
                <li><span class="font-bold">Akhlak:</span> Menanamkan nilai-nilai moral dan etika.</li>
            </ul>
        </div>
    </section>

    <!-- Kegiatan Unggulan -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Kegiatan Unggulan</h2>
            <ul class="list-disc list-inside text-gray-700 text-lg leading-8">
                <li><span class="font-bold">Tahun Baru Hijriyah:</span> Pawai obor dan perlombaan.</li>
                <li><span class="font-bold">Perayaan Maulid Nabi Muhammad SAW:</span> Kegiatan yang meriah dan penuh
                    makna.</li>
                <li><span class="font-bold">Wisuda Tahfidz:</span> Penghargaan bagi santri yang telah menyelesaikan
                    program tahfidz.</li>
                <li><span class="font-bold">Pesantren Ramadhan:</span> Program khusus selama bulan Ramadhan.</li>
                <li><span class="font-bold">Mabit Akhir Tahun:</span> Kegiatan akhir tahun yang diadakan setiap tahun.
                </li>
            </ul>
        </div>
    </section>

    <!-- Biaya Pendaftaran -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-6 lg:px-12 text-center">
            <h2 class="text-3xl font-bold mb-8">Biaya Pendaftaran</h2>
            <p class="text-lg leading-8"><span class="font-bold">Pendaftaran:</span> Rp350.000</p>
            <p class="text-lg leading-8"><span class="font-bold">Syarikah:</span> Rp150.000/bulan</p>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Galeri</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://placehold.co/300x200" alt="Gambar 1" class="w-full">
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://placehold.co/300x200" alt="Gambar 2" class="w-full">
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://placehold.co/300x200" alt="Gambar 3" class="w-full">
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://placehold.co/300x200" alt="Gambar 4" class="w-full">
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://placehold.co/300x200" alt="Gambar 5" class="w-full">
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="https://placehold.co/300x200" alt="Gambar 6" class="w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Kami Section -->
    <section id="kontak" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-12">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Kontak Kami</h2>
            <div class="bg-white shadow-md rounded-lg p-6 md:p-12">
                <p class="text-lg text-gray-700 leading-8 mb-4">
                    Jika Anda tertarik untuk mendaftarkan anak Anda di <span class="font-bold text-blue-600">RTQ
                        TSABATA</span>, silakan hubungi kami:
                </p>
                <ul class="text-lg text-gray-700 leading-8 space-y-3">
                    <li>
                        <span class="font-bold">Telepon:</span>
                        <a href="tel:+6285813776045" class="text-blue-600 hover:underline">0858-1377-6045 (Aghnia)</a>
                        |
                        <a href="tel:+628568525337" class="text-blue-600 hover:underline">0856-8525-337 (Syifa)</a>
                    </li>
                    <li>
                        <span class="font-bold">Email:</span>
                        <a href="mailto:rtq.tsabata@gmail.com"
                            class="text-blue-600 hover:underline">rtq.tsabata@gmail.com</a>
                    </li>
                    <li>
                        <span class="font-bold">Website:</span>
                        <a href="http://www.tsabataqaaiman.com" target="_blank"
                            class="text-blue-600 hover:underline">www.tsabataqaaiman.com</a>
                    </li>
                    <li>
                        <span class="font-bold">Alamat:</span>
                        Kalibata Selatan IIG No. 38, Rt. 02 R. 04 Kel. Kalibata Kec. Pancoran, Jakarta Selatan.
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <footer class="bg-white shadow dark:bg-gray-800">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                    href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
    </footer>

    <!-- Flowbite Script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
