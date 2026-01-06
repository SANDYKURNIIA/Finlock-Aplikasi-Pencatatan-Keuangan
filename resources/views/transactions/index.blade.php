<x-layouts.app title="Riwayat Transaksi">

    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Riwayat Transaksi</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-max">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b">
                        <th class="py-2 px-3">Tanggal</th>
                        <th class="py-2 px-3">Keterangan</th>
                        <th class="py-2 px-3">Kategori</th>
                        <th class="py-2 px-3">Jumlah (Rp)</th>
                        <th class="py-2 px-3">Tipe</th>
                        <th class="py-2 px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-3 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                            </td>
                            <td class="py-3 px-3 text-sm text-gray-800">
                                {{ $transaction->description }}
                            </td>

                            <td class="py-3 px-3 text-sm">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-800">
                                    {{ $transaction->category->name ?? '-' }}
                                </span>
                            </td>

                            <td class="py-3 px-3 text-sm font-medium
                                        @if($transaction->type == 'pemasukan')
                                            text-green-600
                                        @else
                                            text-red-600
                                        @endif">
                                {{ $transaction->type == 'pengeluaran' ? '-' : '' }}
                                {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($transaction->type == 'pemasukan')
                                                bg-green-100 text-green-800
                                            @else
                                                bg-red-100 text-red-800
                                            @endif">
                                    {{ ucfirst($transaction->type) }}
                                </span>
                            </td>
                            <td class="py-3 px-3">
                                <div class="flex space-x-3">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}"
                                        class="text-blue-500 hover:text-blue-700" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    </div>

</x-layouts.app>