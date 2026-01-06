<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon; 
use App\Models\Category;

class DashboardController extends Controller
{
   public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->get();

        $totalPemasukan = $transactions->where('type', 'pemasukan')->sum('amount');
        $totalPengeluaran = $transactions->where('type', 'pengeluaran')->sum('amount');
        $saldoBersih = $totalPemasukan - $totalPengeluaran;

        $recentTransactions = $transactions->sortByDesc('created_at')->take(5);
        $startDate = Carbon::now()->subDays(29);
        $endDate = Carbon::now();

        $pemasukan = Transaction::where('user_id', $user->id)
            ->where('type', 'pemasukan')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw('DATE(transaction_date) as date'),
                DB::raw('SUM(amount) as total')
            ])
            ->pluck('total', 'date');

        $pengeluaran = Transaction::where('user_id', $user->id)
            ->where('type', 'pengeluaran')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw('DATE(transaction_date) as date'),
                DB::raw('SUM(amount) as total')
            ])
            ->pluck('total', 'date');
        
        $chartLabels = [];
        $chartPemasukan = [];
        $chartPengeluaran = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $chartLabels[] = $date->format('d M'); 
            $chartPemasukan[] = $pemasukan->get($formattedDate, 0);
            $chartPengeluaran[] = $pengeluaran->get($formattedDate, 0);
        }
        $categories = Category::all();

        return view('dashboard', [
            'user' => $user,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldoBersih' => $saldoBersih,
            'recentTransactions' => $recentTransactions,
            
            'chartLabels' => $chartLabels,
            'chartPemasukan' => $chartPemasukan,
            'chartPengeluaran' => $chartPengeluaran,
            'categories' => $categories
        ]);
    }
}