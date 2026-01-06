@extends('/components/layouts.public')

@section('title', 'FinLock - Manajemen Keuangan UMKM Aman & Mudah')

@section('content')

    <section class="bg-blue-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                Kelola Keuangan UMKM Anda, <br class="hidden md:block"> Sepenuhnya Aman & Pribadi.
            </h1>
            <p class="mt-4 text-lg md:text-xl text-blue-200 max-w-3xl mx-auto">
                Pencatatan keuangan jadi mudah, cepat, dan dilindungi enkripsi end-to-end. Data Anda hanya milik Anda.
            </p>
            <div class="mt-8">
                <a href="/register" class="bg-yellow-400 text-blue-900 font-bold py-3 px-8 rounded-full text-lg hover:bg-yellow-500 transition duration-300">
                    Coba Gratis Sekarang
                </a>
            </div>
        </div>
    </section>
    <section class="bg-slate-100 py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-600 font-medium">Dipercaya oleh <span class="font-bold text-blue-900">100+</span> Pelaku UMKM di Indonesia</p>
        </div>
    </section>
    <section id="fitur" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900">Semua yang Anda Butuhkan</h2>
                <p class="mt-2 text-gray-600">Fitur dirancang khusus untuk kemudahan dan keamanan UMKM.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Keamanan Terjamin</h3>
                    <p class="text-gray-600">Dengan Enkripsi End-to-End, hanya Anda yang bisa membaca data keuangan Anda. Kami pun tidak bisa.</p>
                </div>
                <div class="text-center p-6">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mx-auto mb-4">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Pencatatan Cepat</h3>
                    <p class="text-gray-600">Catat pemasukan dan pengeluaran harian dalam hitungan detik, langsung dari HP atau laptop Anda.</p>
                </div>
                <div class="text-center p-6">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Laporan Otomatis</h3>
                    <p class="text-gray-600">Dapatkan laporan laba-rugi dan arus kas instan tanpa perlu pusing menghitung manual.</p>
                </div>
                 <div class="text-center p-6">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Dashboard Intuitif</h3>
                    <p class="text-gray-600">Pahami kesehatan bisnis Anda lewat grafik visual yang mudah dimengerti dan modern.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="testimoni" class="py-20 bg-slate-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900">Kata Mereka yang Sudah Pakai</h2>
                <p class="mt-2 text-gray-600">Lihat bagaimana FinLock membantu bisnis mereka bertumbuh.</p>
            </div>
            <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <p class="text-gray-600 italic">"Aplikasi ini benar-benar game changer! Sekarang saya tidak pernah telat mencatat dan bisa lihat untung-rugi kapan saja. Fitur keamanannya bikin saya tenang."</p>
                    <div class="flex items-center mt-6">
                        <img class="w-12 h-12 rounded-full object-cover" src="https://i.pravatar.cc/100?u=a" alt="Anisa">
                        <div class="ml-4">
                            <p class="font-bold text-gray-800">Anisa Putri</p>
                            <p class="text-sm text-gray-500">Pemilik Kedai Kopi "Senja"</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <p class="text-gray-600 italic">"Sebagai pemilik warung, saya butuh yang simpel dan tidak ribet. Finlock sangat mudah dipakai. Laporan keuangannya juga sangat membantu untuk stok barang."</p>
                    <div class="flex items-center mt-6">
                        <img class="w-12 h-12 rounded-full object-cover" src="https://i.pravatar.cc/100?u=b" alt="Budi">
                        <div class="ml-4">
                            <p class="font-bold text-gray-800">Budi Santoso</p>
                            <p class="text-sm text-gray-500">Pemilik Warung Sembako</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <p class="text-gray-600 italic">"Dulu pakai buku tulis sering hilang dan rusak. Sekarang semua data aman di FinLock. Bisa diakses dari mana saja. Sangat direkomendasikan!"</p>
                    <div class="flex items-center mt-6">
                        <img class="w-12 h-12 rounded-full object-cover" src="https://i.pravatar.cc/100?u=c" alt="Citra">
                        <div class="ml-4">
                            <p class="font-bold text-gray-800">Citra Lestari</p>
                            <p class="text-sm text-gray-500">Pengusaha Katering Online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-blue-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h2 class="text-3xl md:text-4xl font-bold">
                Siap Mengambil Kendali Keuangan Bisnis Anda?
            </h2>
            <p class="mt-4 text-lg text-blue-200 max-w-2xl mx-auto">
                Bergabunglah dengan ratusan UMKM lain yang telah merasakan kemudahan dan keamanan dalam mengelola keuangan bisnis.
            </p>
            <div class="mt-8">
                <a href="/register" class="bg-yellow-400 text-blue-900 font-bold py-3 px-8 rounded-full text-lg hover:bg-yellow-500 transition duration-300">
                    Daftar Akun Gratis
                </a>
            </div>
        </div>
    </section>
    @endsection