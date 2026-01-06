<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- Menggunakan nama brand "AmanIN" dari saran sebelumnya, bisa diganti --}}
    <title>@yield('title', 'FinLock - Keuangan UMKM Aman & Terlindungi')</title>

    {{-- Tailwind CSS & Google Fonts (Poppins) via CDN untuk kemudahan --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Alpine.js untuk interaktivitas (seperti menu mobile) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Mengaplikasikan font Poppins ke seluruh halaman */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    {{-- Navigasi --}}
    <nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ open: false }">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-900">FinLock</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#fitur" class="text-gray-600 hover:text-blue-900 px-3 py-2 rounded-md text-sm font-medium">Fitur</a>
                        <a href="#testimoni" class="text-gray-600 hover:text-blue-900 px-3 py-2 rounded-md text-sm font-medium">Testimoni</a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <a href="/login" class="text-gray-600 hover:text-blue-900 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="/register" class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-2 px-4 rounded-full text-sm">Daftar Gratis</a>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <button @click="open = !open" type="button" class="bg-gray-100 inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:bg-gray-200 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        {{-- Menu Mobile --}}
        <div x-show="open" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#fitur" class="text-gray-600 hover:text-blue-900 block px-3 py-2 rounded-md text-base font-medium">Fitur</a>
                <a href="#testimoni" class="text-gray-600 hover:text-blue-900 block px-3 py-2 rounded-md text-base font-medium">Testimoni</a>
                 <a href="/login" class="text-gray-600 hover:text-blue-900 block px-3 py-2 rounded-md text-base font-medium">Login</a>
                <a href="/register" class="bg-yellow-400 w-full block text-center mt-2 hover:bg-yellow-500 text-blue-900 font-bold py-2 px-4 rounded-full text-base">Daftar Gratis</a>
            </div>
        </div>
    </nav>

    <main>
        {{-- Konten dari setiap halaman akan dimuat di sini --}}
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-100">
        <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} Finlock. Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>