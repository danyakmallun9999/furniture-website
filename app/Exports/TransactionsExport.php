<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Untuk header kolom
use Maatwebsite\Excel\Concerns\WithMapping; // Untuk memformat data
use Carbon\Carbon;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $transactions;

    public function __construct($transactions = null)
    {
        $this->transactions = $transactions ?? Transaction::all();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->transactions;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Tanggal Transaksi',
            'Tipe',
            'Jumlah',
            'Deskripsi',
            'Dicatat Oleh',
            'Tanggal Dibuat',
            'Terakhir Diperbarui'
        ];
    }

    /**
     * @param mixed $transaction
     * @return array
     */
    public function map($transaction): array
    {
        return [
            $transaction->id,
            Carbon::parse($transaction->transaction_date)->format('Y-m-d'), // Format tanggal
            ucfirst($transaction->type),
            $transaction->amount,
            $transaction->description,
            $transaction->user->name ?? 'N/A', // Ambil nama user
            $transaction->created_at->format('Y-m-d H:i:s'),
            $transaction->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
