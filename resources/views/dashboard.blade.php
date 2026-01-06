<x-layouts.app title="Dashboard">
    <div x-data="{ modalOpen: false, modalType: 'pemasukan' }">
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ $user->name }}! 👋</h2>
            <p class="text-gray-600">Berikut adalah ringkasan keuangan bisnis Anda bulan ini.</p>
        </div>
        <div class="flex space-x-4 mb-8">
            <button @click="modalOpen = true; modalType = 'pemasukan'" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300">
                + Tambah Pemasukan
            </button>
            <button @click="modalOpen = true; modalType = 'pengeluaran'" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300">
                + Tambah Pengeluaran
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium text-gray-500">Total Pemasukan</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium text-gray-500">Total Pengeluaran</h3>
                <p class="text-3xl font-bold text-red-600 mt-2">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium text-gray-500">Saldo Bersih</h3>
                <p class="text-3xl font-bold text-blue-900 mt-2">Rp {{ number_format($saldoBersih, 0, ',', '.') }}</p>
            </div>
        </div>

        @if(isset($recentTransactions))
            <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">5 Transaksi Terakhir</h3>
                    <a href="{{ route('transactions.index') }}" class="text-sm font-medium text-blue-600 hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="text-left text-sm text-gray-500 border-b">
                                <th class="py-2 px-3">Tanggal</th>
                                <th class="py-2 px-3">Keterangan</th>
                                <th class="py-2 px-3">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentTransactions as $transaction)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                                    <td class="py-3 px-3 text-sm text-gray-800">{{ $transaction->description }}</td>
                                    <td class="py-3 px-3 text-sm font-medium @if($transaction->type == 'pemasukan') text-green-600 @else text-red-600 @endif">
                                        {{ $transaction->type == 'pengeluaran' ? '-' : '' }}
                                        {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-center text-gray-500">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Arus Kas (30 Hari Terakhir)</h3>
    <div>
        <canvas id="cashFlowChart"></canvas>
    </div>
</div>

      <div x-show="modalOpen" @keydown.escape.window="modalOpen = false" 
             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
            
            <div @click.away="modalOpen = false" class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 mx-4">
                
                <h3 class="text-2xl font-semibold mb-4" 
                    x-text="modalType === 'pemasukan' ? 'Tambah Pemasukan Baru' : 'Tambah Pengeluaran Baru'">
                </h3>

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" x-model="modalType">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        
                        <div x-show="modalType === 'pemasukan'">
                            <select name="category_id" :disabled="modalType !== 'pemasukan'" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="" disabled selected>-- Pilih Sumber Pemasukan --</option>
                                @foreach($categories->where('type', 'pemasukan') as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div x-show="modalType === 'pengeluaran'">
                            <select name="category_id" :disabled="modalType !== 'pengeluaran'" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="" disabled selected>-- Pilih Jenis Pengeluaran --</option>
                                @foreach($categories->where('type', 'pengeluaran') as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                        <input type="number" name="amount" id="amount" step="0.01" min="0" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <input type="text" name="description" id="description" placeholder="Contoh: Penjualan Harian / Beli Beras" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label for="transaction_date" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                        <input type="date" name="transaction_date" id="transaction_date" value="{{ date('Y-m-d') }}" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end space-x-4 mt-6">
                        <button type="button" @click="modalOpen = false" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg">
                            Batal
                        </button>
                        <button type="submit" class="text-white font-bold py-2 px-4 rounded-lg shadow transition duration-200" 
                                :class="modalType === 'pemasukan' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-red-500 hover:bg-red-600'">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <script>
        // Jalankan skrip setelah halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('cashFlowChart').getContext('2d');

            // Ambil data dari Blade (dikonversi dari PHP ke JS)
            const labels = @json($chartLabels);
            const pemasukanData = @json($chartPemasukan);
            const pengeluaranData = @json($chartPengeluaran);

            new Chart(ctx, {
                type: 'line', // Tipe chart
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: pemasukanData,
                            borderColor: 'rgb(34, 197, 94)', // Hijau (Tailwind Green-600)
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: 'Pengeluaran',
                            data: pengeluaranData,
                            borderColor: 'rgb(239, 68, 68)', // Merah (Tailwind Red-500)
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            fill: true,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            // Format tooltip agar menampilkan Rupiah
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    </div> </x-layouts.app>