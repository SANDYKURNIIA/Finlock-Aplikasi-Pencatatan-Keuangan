<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FinLock - Keuangan UMKM Aman' }}</title>

    {{-- Tailwind CSS & Google Fonts (Poppins) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    

    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-100">

    <div class="flex min-h-screen">
        <div class="hidden lg:flex w-1/2 bg-blue-900 text-white p-12 flex-col justify-between">
            <div>
                <a href="/" class="text-3xl font-bold">FinLock</a>
                <p class="mt-4 text-lg text-blue-200">Platform terpercaya untuk mengelola keuangan UMKM Anda dengan keamanan maksimal.</p>
            </div>
            <div>
                 <p class="text-sm text-blue-300">&copy; {{ date('Y') }} FinLock. Semua Hak Cipta Dilindungi.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                {{-- Logo untuk tampilan mobile --}}
                 <div class="lg:hidden text-center mb-8">
                     <a href="/" class="text-3xl font-bold text-blue-900">FinLock</a>
                 </div>

                {{-- Slot untuk form login atau register --}}
                <div class="bg-white p-8 rounded-2xl shadow-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

</body>
</html>