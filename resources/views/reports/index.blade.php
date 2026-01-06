<x-layouts.app title="Laporan Keuangan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Laporan Keuangan</h3>
            
<form action="{{ route('reports.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-start">
    
    <div class="w-full md:w-auto">
        <label for="start_date" class="block text-sm font-medium text-gray-600 mb-1">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date" 
               value="{{ request('start_date', $startDate) }}"
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('start_date') border-red-500 @enderror">
        
        {{-- Pesan Error Start Date --}}
        @error('start_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="w-full md:w-auto">
        <label for="end_date" class="block text-sm font-medium text-gray-600 mb-1">Tanggal Selesai</label>
        <input type="date" name="end_date" id="end_date" 
               value="{{ request('end_date', $endDate) }}"
               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('end_date') border-red-500 @enderror">
        
        {{-- Pesan Error End Date --}}
        @error('end_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap gap-2 mt-auto pb-1 w-full md:w-auto">
        
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition shadow-sm">
            Terapkan Filter
        </button>

        <a href="{{ route('reports.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-6 rounded-md transition text-center shadow-sm">
            Reset
        </a>

        <a href="{{ route('reports.pdf', ['start_date' => request('start_date', $startDate), 'end_date' => request('end_date', $endDate)]) }}" 
           class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-md transition shadow-sm ml-auto md:ml-0">
            Download PDF
        </a>
        
    </div>
</form>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">
                Laporan Laba-Rugi ({{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} – {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }})
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Pemasukan</p>
                    <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>

                <div class="bg-red-50 p-6 rounded-lg border border-red-100">
                    <p class="text-sm text-gray-500 font-medium mb-1">Total Pengeluaran</p>
                    <p class="text-3xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <p class="text-sm text-gray-500 font-medium mb-1">Laba / Rugi Bersih</p>
                    <p class="text-3xl font-bold {{ $labaBersih >= 0 ? 'text-blue-600' : 'text-red-600' }}">
                        Rp {{ number_format($labaBersih, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
               <div>
                   <h4 class="font-bold text-gray-700 mb-3 border-b pb-2">Rincian Pemasukan</h4>
                   @forelse($pemasukan as $cat => $val)
                       <div class="flex justify-between py-2 border-b border-gray-50 last:border-0">
                           <span class="text-gray-600">{{ $cat }}</span>
                           <span class="font-medium text-gray-800">Rp {{ number_format($val, 0, ',', '.') }}</span>
                       </div>
                   @empty
                       <p class="text-gray-400 italic text-sm">Tidak ada data.</p>
                   @endforelse
               </div>

               <div>
                   <h4 class="font-bold text-gray-700 mb-3 border-b pb-2">Rincian Pengeluaran</h4>
                   @forelse($pengeluaran as $cat => $val)
                       <div class="flex justify-between py-2 border-b border-gray-50 last:border-0">
                           <span class="text-gray-600">{{ $cat }}</span>
                           <span class="font-medium text-gray-800">Rp {{ number_format($val, 0, ',', '.') }}</span>
                       </div>
                   @empty
                       <p class="text-gray-400 italic text-sm">Tidak ada data.</p>
                   @endforelse
               </div>
            </div>

        </div>
    </div>
</x-layouts.app>
<script>
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');

    // Saat tanggal mulai berubah
    startInput.addEventListener('change', function() {
        // Set minimum tanggal selesai harus sama dengan tanggal mulai
        endInput.min = this.value;
        
        // Jika tanggal selesai sekarang lebih kecil dari tanggal mulai baru, reset tanggal selesai
        if (endInput.value && endInput.value < this.value) {
            endInput.value = this.value;
        }
    });
</script>