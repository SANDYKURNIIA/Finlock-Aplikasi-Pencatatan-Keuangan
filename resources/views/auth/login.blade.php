<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<x-layouts.guest title="Login ke Akun Anda">
    <h2 class="text-2xl font-bold text-gray-800 mb-1">Selamat Datang Kembali!</h2>
    <p class="text-gray-600 mb-6">Silakan masuk untuk melanjutkan.</p>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4" x-data="{ show: false }">
            <div class="flex justify-between">
                <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Lupa password?
                </a>
            </div>
            <!-- 1. Tambahkan div 'relative' untuk membungkus input dan ikon -->
            <div class="relative">
                <!-- 2. Ganti type="password" menjadi :type="show ? 'text' : 'password'" -->
                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pr-10">

                <!-- 3. Tambahkan tombol ikon mata -->
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                    <!-- Ikon mata tertutup (default) -->
                    <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243l-4.243-4.243" />
                    </svg>
                    <!-- Ikon mata terbuka -->
                    <svg x-show="show" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.432 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-blue-900 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>
        <div class="mt-4">
            {!! NoCaptcha::display() !!}
            @error('g-recaptcha-response')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-6">
            <button type="submit"
                class="w-full justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-blue-900 bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-300">
                Login
            </button>
        </div>
        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline">
                Daftar di sini
            </a>
        </p>
    </form>
</x-layouts.guest>