<x-layouts.app title="Manajemen Pengguna">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Manajemen Pengguna</h2>

    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <div class="overflow-x-auto">
            <table class="w-full min-w-max">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b">
                        <th class="py-2 px-3">Nama</th>
                        <th class="py-2 px-3">Email</th>
                        <th class="py-2 px-3">Tanggal Bergabung</th>
                        <th class="py-2 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-3">{{ $user->name }}</td>
                            <td class="py-3 px-3">{{ $user->email }}</td>
                            <td class="py-3 px-3">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-3">
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="button" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')" class="text-red-500 hover:text-red-700 text-sm font-medium transition duration-150 ease-in-out">
                                              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada pengguna terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(userId, userName) {
            Swal.fire({
                title: 'Hapus Pengguna?',
                text: "Anda akan menghapus pengguna " + userName + ". SEMUA data transaksinya akan ikut terhapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
            });
        @endif
    </script>

</x-layouts.app>