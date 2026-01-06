<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function dashboard()
    {
   $totalUsers = User::count();
    $totalTransactions = Transaction::count();
    $totalAmount = Transaction::sum('amount');


    $usersData = User::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%M') as month_name"), DB::raw("MONTH(created_at) as month_num"))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name', 'month_num')
        ->orderBy('month_num')
        ->get();
    
    $chartUserLabels = $usersData->pluck('month_name');
    $chartUserValues = $usersData->pluck('count');

    // 3. Data Grafik: Pemasukan vs Pengeluaran (Global)
    $pemasukan = Transaction::where('type', 'pemasukan')->sum('amount');
    $pengeluaran = Transaction::where('type', 'pengeluaran')->sum('amount');

    return view('admin.dashboard', compact(
        'totalUsers', 
        'totalTransactions', 
        'totalAmount',
        'chartUserLabels',
        'chartUserValues',
        'pemasukan',
        'pengeluaran'
    ));
    }
    public function users()
    {
        // Ambil semua user, kecuali admin sendiri
        $users = User::where('is_admin', 0)->latest()->paginate(10);

        return view('admin.users', [
            'users' => $users
        ]);
    }
   public function userDestroy(User $user)
    {
        // 1. Validasi Keamanan: Jangan hapus sesama admin
        if ($user->is_admin) {
            return back()->with('error', 'Tidak dapat menghapus akun Administrator.');
        }

        try {
            $user->delete();

            return back()->with('success', 'Pengguna dan data transaksinya berhasil dihapus.');
        
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
    public function exportUsersPdf()
{
    $users = User::orderBy('created_at', 'desc')->get();
    $totalUsers = $users->count();
    $pdf = Pdf::loadView('admin.users.pdf', compact('users', 'totalUsers'));
    $pdf->setPaper('a4', 'portrait');

    return $pdf->download('Data-Pengguna-FinLock.pdf');
}
}
