<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Pemasukan
            ['name' => 'Penjualan Produk', 'type' => 'pemasukan'],
            ['name' => 'Investasi Masuk', 'type' => 'pemasukan'],
            ['name' => 'Lain-lain (Masuk)', 'type' => 'pemasukan'],
            
            // Pengeluaran
            ['name' => 'Biaya Bahan Baku', 'type' => 'pengeluaran'],
            ['name' => 'Gaji Karyawan', 'type' => 'pengeluaran'],
            ['name' => 'Sewa Tempat', 'type' => 'pengeluaran'],
            ['name' => 'Listrik & Air', 'type' => 'pengeluaran'],
            ['name' => 'Pemasaran/Iklan', 'type' => 'pengeluaran'],
            ['name' => 'Lain-lain (Keluar)', 'type' => 'pengeluaran'],
        ];
        DB::table('categories')->insert($categories);
    }
}
