<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} - FinLock</title>

    {{-- Tailwind CSS & Google Fonts (Poppins) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    {{-- Alpine.js untuk interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-slate-100">

    <div x-data="{ sidebarOpen: true, mobileMenuOpen: false }" class="relative flex h-screen bg-slate-100">

        <aside
            class="fixed inset-y-0 left-0 z-30 flex h-screen w-64 flex-col overflow-y-auto bg-white shadow-lg transition-all duration-300 ease-in-out md:translate-x-0"
            :class="{
                'translate-x-0': mobileMenuOpen,
                '-translate-x-full': !mobileMenuOpen,
                'md:w-64': sidebarOpen,
                'md:w-20': !sidebarOpen
            }"
            x-cloak>

            <div class="flex h-16 shrink-0 items-center bg-white shadow-md"
                :class="sidebarOpen ? 'justify-between px-4' : 'justify-center'">
                
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-900"
                    :class="sidebarOpen ? 'block' : 'hidden'">FinLock</a>
                
                <button @click="sidebarOpen = !sidebarOpen"
                    class="hidden rounded-full p-1 text-gray-600 hover:bg-gray-200 md:block">
                    <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <nav class="flex-1 space-y-2 px-2 py-4">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center rounded-md py-2.5 transition-colors
                    {{ request()->routeIs('dashboard') ? 'bg-gray-200 text-gray-700' : 'text-gray-600 hover:bg-gray-200' }}"
                    :class="sidebarOpen ? 'px-4' : 'justify-center px-3'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="overflow-hidden whitespace-nowrap transition-all"
                        :class="sidebarOpen ? 'ml-3' : 'w-0 opacity-0'">Dashboard</span>
                </a>

                <a href="{{ route('transactions.index') }}"
                    class="flex items-center rounded-md py-2.5 transition-colors
                    {{ request()->routeIs('transactions.*') ? 'bg-gray-200 text-gray-700' : 'text-gray-600 hover:bg-gray-200' }}"
                    :class="sidebarOpen ? 'px-4' : 'justify-center px-3'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="overflow-hidden whitespace-nowrap transition-all"
                        :class="sidebarOpen ? 'ml-3' : 'w-0 opacity-0'">Transaksi</span>
                </a>

                <a href="{{ route('reports.index') }}"
                    class="flex items-center rounded-md py-2.5 transition-colors
                    {{ request()->routeIs('reports.*') ? 'bg-gray-200 text-gray-700' : 'text-gray-600 hover:bg-gray-200' }}"
                    :class="sidebarOpen ? 'px-4' : 'justify-center px-3'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="overflow-hidden whitespace-nowrap transition-all"
                        :class="sidebarOpen ? 'ml-3' : 'w-0 opacity-0'">Laporan</span>
                </a>
            </nav>
        </aside>

        <div class="flex flex-1 flex-col overflow-y-auto transition-all duration-300 ease-in-out"
            :class="{ 'md:ml-64': sidebarOpen, 'md:ml-20': !sidebarOpen }">

          <header
    class="sticky top-0 z-10 flex h-16 items-center justify-between border-b border-gray-200 bg-white shadow-md">
    <div class="flex items-center px-4">
        {{-- ... (Tombol menu & Judul Halaman) ... --}}
         <h1 class="ml-3 text-xl font-bold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
    </div>

    <div class="flex items-center pr-4" x-data="{ open: false }">
        <div class="relative">
            <button @click="open = !open"
                class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                
                <img class="mr-2 h-8 w-8 rounded-full object-cover" 
                     src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&color=fff&size=32' }}" 
                     alt="Foto Profil">
                <div class="hidden md:block">{{ Auth::user()->name }}</div>
                <div class="ml-1">
                    {{-- ... (ikon panah bawah) ... --}}
                </div>
            </button>
            
            {{-- Dropdown Menu --}}
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 z-50 mt-2 w-48 rounded-md bg-white py-2 shadow-xl" x-cloak>
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="confirmLogout(event)"
                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">
                        Logout
                    </a>
                </form>
            </div>
        </div>
    </div>
</header>
            
            <main class="flex-1 p-4 md:p-8">
                {{-- Konten utama dari setiap halaman akan dimuat di sini --}}
                {{ $slot }}
            </main>
        </div>

        <div x-show="mobileMenuOpen" @click="mobileMenuOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity md:hidden" x-cloak>
        </div>

    </div>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 1000,
                showConfirmButton: false
            });
        @endif
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah link langsung berjalan

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sesi ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, submit form logout
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>

</html>