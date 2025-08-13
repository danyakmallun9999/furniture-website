<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InvoicesImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $customerId = null;
        if (!empty($row['customer_name'])) {
            $customer = Customer::firstOrCreate(['name' => $row['customer_name']]);
            $customerId = $customer->id;
        }

        return new Invoice([
            'customer_id' => $customerId,
            'user_id' => auth()->id(),
            'invoice_number' => $row['invoice_number'],
            'invoice_date' => Carbon::parse($row['invoice_date'])->format('Y-m-d'),
            'due_date' => !empty($row['due_date']) ? Carbon::parse($row['due_date'])->format('Y-m-d') : null,
            'type' => $row['type'],
            'total_amount' => $row['total_amount'],
            'payment_status' => $row['payment_status'],
            'notes' => $row['notes'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.invoice_number' => ['required', 'string', 'max:255', 'unique:invoices,invoice_number'],
            '*.invoice_date' => ['required', 'date'],
            '*.due_date' => ['nullable', 'date', 'after_or_equal:invoice_date'],
            '*.type' => ['required', 'in:kredit,debit'],
            '*.total_amount' => ['required', 'numeric', 'min:0'],
            '*.payment_status' => ['required', 'in:pending,paid,canceled'],
            '*.customer_name' => ['nullable', 'string', 'max:255'],
            '*.notes' => ['nullable', 'string'],
        ];
    }
} 