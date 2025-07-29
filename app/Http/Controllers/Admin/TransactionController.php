<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction; // Impor model Transaction
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Impor Auth facade untuk mendapatkan user yang login

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil filter dari request
        $type = $request->input('type'); // 'kredit' atau 'debit'
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $search = $request->input('search');

        $transactions = Transaction::latest()
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('transaction_date', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('transaction_date', '<=', $endDate);
            })
            ->when($search, function ($query, $search) {
                return $query->where('description', 'like', '%' . $search . '%')
                             ->orWhere('amount', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Paginate hasilnya

        return view('admin.transactions.index', compact('transactions', 'type', 'startDate', 'endDate', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:kredit,debit', // Hanya boleh 'kredit' atau 'debit'
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        Transaction::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'transaction_date' => $request->transaction_date,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:kredit,debit',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $transaction->update([
            'transaction_date' => $request->transaction_date,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
