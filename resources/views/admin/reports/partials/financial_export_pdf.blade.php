{{-- resources/views/admin/reports/partials/financial_export_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 16px; }
        .title { font-size: 18px; font-weight: bold; margin: 0; }
        .subtitle { font-size: 12px; color: #666; margin: 4px 0 0 0; }
        .filters { font-size: 10px; color: #555; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; }
        th { background: #f2f2f2; font-weight: bold; text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">Laporan Transaksi</p>
        <p class="subtitle">{{ config('app.name', 'Furniture Website') }}</p>
    </div>

    <div class="filters">
        @if($type)
            <span><strong>Tipe:</strong> {{ ucfirst($type) }}</span>
        @endif
        @if($startDate)
            <span style="margin-left: 10px;"><strong>Dari:</strong> {{ $startDate }}</span>
        @endif
        @if($endDate)
            <span style="margin-left: 10px;"><strong>Sampai:</strong> {{ $endDate }}</span>
        @endif
        @if($search)
            <span style="margin-left: 10px;"><strong>Cari:</strong> {{ $search }}</span>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 14%">Tanggal</th>
                <th style="width: 10%">Tipe</th>
                <th style="width: 20%">No Transaksi</th>
                <th style="width: 24%">Pelanggan</th>
                <th style="width: 16%" class="text-right">Total</th>
                <th style="width: 16%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ optional($invoice->invoice_date)->format('d M Y') }}</td>
                    <td>{{ ucfirst($invoice->type) }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->customer->name ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($invoice->payment_status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html> 