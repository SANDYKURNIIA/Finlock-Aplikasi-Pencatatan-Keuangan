<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <meta http-equiv="refresh" content="5; url={{ route('index') }}">
</head>
<body class="bg-gray-200">

    <section class="flex items-center h-screen p-16">
        <div class="container flex flex-col items-center">
            <div class="flex flex-col gap-6 max-w-md text-center">
                <h2 class="font-extrabold text-9xl text-gray-600">
                    <span class="sr-only">Error</span>404
                </h2>
                <p class="text-2xl md:text-3xl">
                    Halaman tidak ditemukan. Anda akan diarahkan kembali ke halaman utama...
                </p>
                <a href="{{ route('index') }}" class="bg-yellow-400 text-blue-900 font-bold py-3 px-8 rounded-full text-lg hover:bg-yellow-500 transition duration-300">
                    Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </section>

</body>
</html>