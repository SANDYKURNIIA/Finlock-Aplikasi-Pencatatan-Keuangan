<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);
        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);
        return redirect()->route('dashboard')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }
    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            return redirect()->route('transactions.index')->with('error', 'Anda tidak diizinkan mengedit transaksi ini.');
        }
        $categories = Category::all();
        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories' => $categories
        ]);
    }
    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            return redirect()->route('transactions.index')->with('error', 'Anda tidak diizinkan mengedit transaksi ini.');
        }
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);
        $transaction->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);
        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');

            
    }
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
                                ->with('category')
                                ->latest('transaction_date')
                                ->paginate(10);
        $categories = Category::all();
        return view('transactions.index', [
            'transactions' => $transactions,
            'categories' => $categories
        ]);
    }
    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak diizinkan menghapus transaksi ini.');
        }
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
