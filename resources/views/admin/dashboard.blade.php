<x-layouts.app title="Admin Dashboard">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-blue-500 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Pengguna</h3>
                <p class="text-3xl font-bold text-blue-900 mt-2">{{ $totalUsers }}</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-green-500 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Transaksi</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalTransactions }}</p>
            </div>
            <div class="p-3 bg-green-100 rounded-full text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-red-500 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Perputaran Uang</h3>
                <p class="text-3xl font-bold text-red-600 mt-2">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
            </div>
            <div class="p-3 bg-red-100 rounded-full text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Tren Pendaftaran Pengguna (Tahun Ini)</h3>
            <div class="relative h-64">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Komposisi Transaksi Global</h3>
            <div class="relative h-64 flex justify-center">
                <canvas id="transactionPieChart"></canvas>
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-4 mb-8">
        <a href="{{ route('admin.users.export-pdf') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md flex items-center transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download Data User
        </a>

        <a href="{{ route('admin.users.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md flex items-center transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Kelola User
        </a>
    </div>

    <script>
        // 1. Line Chart
        const ctxUser = document.getElementById('userGrowthChart').getContext('2d');
        new Chart(ctxUser, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartUserLabels) !!},
                datasets: [{
                    label: 'Pengguna Baru',
                    data: {!! json_encode($chartUserValues) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
            }
        });

        // 2. Doughnut Chart
        const ctxPie = document.getElementById('transactionPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ['Total Pemasukan', 'Total Pengeluaran'],
                datasets: [{
                    data: [{{ $pemasukan }}, {{ $pengeluaran }}],
                    backgroundColor: ['#22c55e', '#ef4444'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>

</x-layouts.app>