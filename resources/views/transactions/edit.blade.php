<x-layouts.app title="Edit Transaksi">

    <div class="bg-white p-6 rounded-lg shadow-lg mb-8 max-w-2xl mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Edit Transaksi</h3>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT') 

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Tipe Transaksi</label>
                <input type="text" id="type" value="{{ $transaction->type == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed" 
                       disabled>
                <p class="text-xs text-gray-500 mt-1">Tipe transaksi tidak dapat diubah agar data konsisten.</p>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" id="category_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="" disabled>-- Pilih Kategori --</option>
                    
                    @foreach($categories as $cat)
                        {{-- Logika: Hanya tampilkan kategori yang tipenya SAMA dengan transaksi ini --}}
                        @if($cat->type == $transaction->type)
                            <option value="{{ $cat->id }}" 
                                {{ $transaction->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                <input type="number" name="amount" id="amount" step="0.01" min="0" 
                       value="{{ $transaction->amount }}" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" name="description" id="description" 
                       value="{{ $transaction->description }}" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="transaction_date" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" id="transaction_date" 
                       value="{{ $transaction->transaction_date }}" 
                       required 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('transactions.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</x-layouts.app>