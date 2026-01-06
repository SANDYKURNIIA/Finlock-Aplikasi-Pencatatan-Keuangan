<x-layouts.guest title="Reset Password">
    <h2 class="text-2xl font-bold text-gray-800 mb-1">Lupa Password Anda?</h2>
    <p class="text-gray-600 mb-6">Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda.</p>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50
                   @error('email') border-red-500 @enderror">
            
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                Kirim Link Reset Password
            </button>
        </div>

        <p class="text-center text-sm text-gray-600 mt-6">
            Ingat password Anda?
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline">
                Kembali ke Login
            </a>
        </p>
    </form>
</x-layouts.guest>