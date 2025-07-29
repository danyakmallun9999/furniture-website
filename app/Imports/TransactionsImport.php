<?php

namespace App\Imports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Untuk mengabaikan baris header
use Maatwebsite\Excel\Concerns\WithValidation; // Untuk validasi data
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transaction([
            'user_id' => Auth::id(), // Dicatat oleh user yang mengimpor
            'transaction_date' => Carbon::parse($row['tanggal_transaksi']), // Pastikan nama kolom di Excel sesuai
            'type' => strtolower($row['tipe']), // pastikan 'kredit' atau 'debit'
            'amount' => $row['jumlah'],
            'description' => $row['deskripsi'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'tanggal_transaksi' => 'required|date',
            'tipe' => 'required|in:kredit,debit,Kredit,Debit', // Validasi tipe
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'required|string|max:255',
        ];
    }
}
