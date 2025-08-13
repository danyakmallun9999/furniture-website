<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class InvoicesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $invoices;

    public function __construct($invoices = null)
    {
        $this->invoices = $invoices ?? Invoice::with(['customer', 'user'])->get();
    }

    public function collection()
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return [
            'ID Invoice',
            'Tanggal Invoice',
            'Tipe',
            'Total',
            'Nomor Invoice',
            'Pelanggan',
            'Status Pembayaran',
            'Dibuat Oleh',
            'Tanggal Dibuat',
            'Terakhir Diperbarui',
        ];
    }

    public function map($invoice): array
    {
        return [
            $invoice->id,
            Carbon::parse($invoice->invoice_date)->format('Y-m-d'),
            ucfirst($invoice->type),
            $invoice->total_amount,
            $invoice->invoice_number,
            $invoice->customer->name ?? 'N/A',
            ucfirst($invoice->payment_status),
            $invoice->user->name ?? 'N/A',
            $invoice->created_at->format('Y-m-d H:i:s'),
            $invoice->updated_at->format('Y-m-d H:i:s'),
        ];
    }
} 