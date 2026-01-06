<x-layouts.app title="Edit Profil">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-lg sticky top-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Foto Profil</h3>
                    
                    <div class="flex justify-center mb-4">
                        <img id="photoPreview"
                             src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&color=fff&size=128' }}" 
                             alt="Foto Profil" 
                             class="w-40 h-40 rounded-full object-cover border-4 border-gray-200">
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Ganti Foto</label>
                        <input type="file" name="photo" id="photo" 
                               class="mt-1 block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100"
                               onchange="document.getElementById('photoPreview').src = window.URL.createObjectURL(this.files[0])">
                        <p class="text-xs text-gray-500 mt-2">JPG, JPEG, atau PNG. Maks 2MB.</p>
                         @error('photo')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Informasi Profil</h3>
                    
                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('name') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>

        
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('email') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Perbarui Password</h3>
                    <p class="text-gray-600 mb-4 text-sm">Biarkan kosong jika Anda tidak ingin mengubah password.</p>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" name="password" id="password" autocomplete="new-password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('password') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-8">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300">
                Simpan Semua Perubahan
            </button>
        </div>
        
    </form> 
</x-layouts.app>