{{-- resources/views/admin/invoices/pdf.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        /* CSS inline atau tertanam untuk PDF */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            /* Menggunakan font yang kompatibel dengan Dompdf */
            font-size: 10px;
            line-height: 1.5;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2F4F4F;
            /* primary-dark-green */
        }

        .header p {
            font-size: 12px;
            color: #666;
        }

        .invoice-details,
        .customer-details {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .invoice-details td,
        .customer-details td {
            padding: 5px 0;
            vertical-align: top;
        }

        .invoice-details td:first-child,
        .customer-details td:first-child {
            width: 150px;
            font-weight: bold;
            color: #555;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #555;
        }

        .total-row {
            text-align: right;
            padding-top: 10px;
        }

        .total-row strong {
            font-size: 16px;
            color: #2F4F4F;
            /* primary-dark-green */
        }

        .notes {
            margin-top: 20px;
            font-size: 10px;
            color: #666;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            background-color: #ccc;
            /* default */
        }

        .status-badge.pending {
            background-color: #FFC107;
        }

        /* yellow */
        .status-badge.paid {
            background-color: #28A745;
        }

        /* green */
        .status-badge.canceled {
            background-color: #DC3545;
        }

        /* red */
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>INVOICE</h1>
            <p>{{ config('app.name', 'Furniture Website') }}</p>
            <p>Jl. Industri Mebel No. 123, Kota Kayu, Indonesia</p>
            <p>Email: info@furnituresite.com | Telp: +62 812 3456 7890</p>
        </div>

        <table class="invoice-details">
            <tr>
                <td>Nomor Invoice:</td>
                <td>{{ $invoice->invoice_number }}</td>
            </tr>
            <tr>
                <td>Tanggal Invoice:</td>
                <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
            </tr>
            <tr>
                <td>Jatuh Tempo:</td>
                <td>{{ $invoice->due_date ? $invoice->due_date->format('d M Y') : '-' }}</td>
            </tr>
            <tr>
                <td>Status Pembayaran:</td>
                <td>
                    <span class="status-badge {{ $invoice->payment_status }}">
                        {{ ucfirst($invoice->payment_status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Dibuat Oleh:</td>
                <td>{{ $invoice->user->name ?? 'N/A' }}</td>
            </tr>
        </table>

        <table class="customer-details">
            <tr>
                <td colspan="2">
                    <h3>Kepada:</h3>
                </td>
            </tr>
            <tr>
                <td>Nama Pelanggan:</td>
                <td>{{ $invoice->customer->name ?? 'N/A' }}</td>
            </tr>
            @if ($invoice->customer->email)
                <tr>
                    <td>Email:</td>
                    <td>{{ $invoice->customer->email }}</td>
                </tr>
            @endif
            @if ($invoice->customer->phone)
                <tr>
                    <td>Telepon:</td>
                    <td>{{ $invoice->customer->phone }}</td>
                </tr>
            @endif
            @if ($invoice->customer->address)
                <tr>
                    <td>Alamat:</td>
                    <td>{{ $invoice->customer->address }}</td>
                </tr>
            @endif
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Motif</th>
                    <th style="text-align: right;">Harga Satuan</th>
                    <th style="text-align: center;">Kuantitas</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $item)
                    <tr>
                        <td>{{ $item->product_name_at_sale }}</td>
                        <td>{{ $item->product_motif_at_sale ?? '-' }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item->total_item_price, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;"><strong>TOTAL:</strong></td>
                    <td style="text-align: right;"><strong>Rp
                            {{ number_format($invoice->total_amount, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        @if ($invoice->notes)
            <div class="notes">
                <h3>Catatan:</h3>
                <p>{{ $invoice->notes }}</p>
            </div>
        @endif

        <div style="margin-top: 50px; text-align: center;">
            <p>Terima kasih atas kepercayaan Anda.</p>
        </div>
    </div>
</body>

</html>
