<x-layouts.guest title="Buat Akun Baru">
    <h2 class="text-2xl font-bold text-gray-800 mb-1">Daftar Akun Baru</h2>
    <p class="text-gray-600 mb-6">Mulai kelola keuangan Anda dengan aman.</p>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
             @error('name')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
             @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4" x-data="{ show: false }">
            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pr-10">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                    <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243l-4.243-4.243" /></svg>
                    <svg x-show="show" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.432 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </button>
            </div>
            @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mt-4" x-data="{ show: false }">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
            <div class="relative">
                <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required
                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pr-10">
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                    <svg x-show="!show" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243l-4.243-4.243" /></svg>
                    <svg x-show="show" x-cloak class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" ><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.432 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </button>
            </div>
        </div>

        <!-- Tombol Daftar -->
        <div class="mt-6">
            <button type="submit" class="w-full justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-blue-900 bg-yellow-400 hover:bg-yellow-500 transition duration-300">
                Daftar
            </button>
        </div>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline">
                Login di sini
            </a>
        </p>
    </form>
</x-layouts.guest>