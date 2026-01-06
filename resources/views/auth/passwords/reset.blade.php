<x-layouts.guest title="Reset Password">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Password Baru</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Password Baru</label>
            <input id="password" type="password" name="password" required
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @error('password')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>

        <div>
            <button type="submit" class="w-full justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-blue-900 hover:bg-blue-800 focus:outline-none transition duration-300">
                Reset Password
            </button>
        </div>
    </form>
</x-layouts.guest>