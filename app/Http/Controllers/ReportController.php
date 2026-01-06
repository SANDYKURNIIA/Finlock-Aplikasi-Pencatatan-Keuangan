<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ], [
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh kurang dari tanggal mulai.',
        ]);

        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $data = $this->getReportData($startDate, $endDate);

        // 3. Tampilkan View
        return view('reports.index', array_merge($data, [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]));
    }

    public function downloadPdf(Request $request)
    {
        $request->validate([
        'start_date' => 'nullable|date',
        'end_date'   => 'nullable|date|after_or_equal:start_date', 
    ]);
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $data = $this->getReportData($startDate, $endDate);

        $pdf = Pdf::loadView('reports.pdf', array_merge($data, [
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]));

        return $pdf->download('Laporan_' . $startDate . '_sd_' . $endDate . '.pdf');
    }

    // Fungsi Private untuk Query Database (Agar tidak menulis ulang)
    private function getReportData($startDate, $endDate)
    {
        $userId = Auth::id();

        // Query Pemasukan (Rentang Tanggal)
        $pemasukan = Transaction::with('category')
            ->where('user_id', $userId)
            ->where('type', 'pemasukan')
            ->whereBetween('transaction_date', [$startDate, $endDate]) // <--- KUNCI UTAMA
            ->get();

        // Query Pengeluaran (Rentang Tanggal)
        $pengeluaran = Transaction::with('category')
            ->where('user_id', $userId)
            ->where('type', 'pengeluaran')
            ->whereBetween('transaction_date', [$startDate, $endDate]) // <--- KUNCI UTAMA
            ->get();

        // Hitung Total
        $totalPemasukan = $pemasukan->sum('amount');
        $totalPengeluaran = $pengeluaran->sum('amount');
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        // Grouping untuk detail di tabel/PDF
        $pemasukanPerKategori = $pemasukan->groupBy('category.name')->map->sum('amount');
        $pengeluaranPerKategori = $pengeluaran->groupBy('category.name')->map->sum('amount');

        return [
            'pemasukan' => $pemasukanPerKategori,
            'pengeluaran' => $pengeluaranPerKategori,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaBersih' => $labaBersih
        ];
    }
}