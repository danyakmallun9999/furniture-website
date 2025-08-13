{{-- resources/views/admin/reports/import.blade.php --}}

<x-app-layout>
	<x-slot name="header">
		<div class="flex items-center justify-between w-full">
			<div class="flex items-center space-x-4">
				<div>
					<h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
						Impor Transaksi
					</h2>
					<p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
						Unggah data transaksi dari file Excel
					</p>
				</div>
			</div>
		</div>
	</x-slot>

	<div class="py-8">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			{{-- Success Message --}}
			@if (session('success'))
				<div class="mb-6 group relative">
					<div class="absolute inset-0 bg-emerald-100 dark:bg-emerald-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
					<div class="relative bg-white dark:bg-slate-900 rounded-2xl p-4 shadow-xl border border-emerald-200 dark:border-emerald-800">
						<div class="flex items-center space-x-3">
							<div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center">
								<i data-lucide="check-circle" class="w-4 h-4 text-white"></i>
							</div>
							<span class="text-emerald-700 dark:text-emerald-300 font-medium">{{ session('success') }}</span>
						</div>
					</div>
				</div>
			@endif

			@if (session('error'))
				<div class="mb-6 group relative">
					<div class="absolute inset-0 bg-red-100 dark:bg-red-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
					<div class="relative bg-white dark:bg-slate-900 rounded-2xl p-4 shadow-xl border border-red-200 dark:border-red-800">
						<div class="flex items-center space-x-3">
							<div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center">
								<i data-lucide="alert-circle" class="w-4 h-4 text-white"></i>
							</div>
							<span class="text-red-700 dark:text-red-300 font-medium">{{ session('error') }}</span>
						</div>
					</div>
				</div>
			@endif

			@if ($errors->any())
				<div class="mb-6 group relative">
					<div class="absolute inset-0 bg-red-100 dark:bg-red-900/20 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
					<div class="relative bg-white dark:bg-slate-900 rounded-2xl p-4 shadow-xl border border-red-200 dark:border-red-800">
						<div class="flex items-center space-x-3">
							<div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center">
								<i data-lucide="alert-circle" class="w-4 h-4 text-white"></i>
							</div>
							<div>
								<span class="text-red-700 dark:text-red-300 font-medium">Terjadi kesalahan:</span>
								<ul class="list-disc list-inside mt-1 text-sm text-red-600 dark:text-red-400">
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			@endif

			{{-- Main Content Card --}}
			<div class="group relative">
				<div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 rounded-2xl opacity-75 group-hover:opacity-100 blur-sm group-hover:blur-none transition-all duration-300"></div>
				<div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-slate-200 dark:border-slate-700">
					{{-- Header Section --}}
					<div class="p-6 border-b border-slate-200 dark:border-slate-700">
						<div class="flex items-center space-x-3">
							<div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
								<i data-lucide="upload" class="w-5 h-5 text-white"></i>
							</div>
							<div>
								<h3 class="text-lg font-bold text-slate-900 dark:text-white">Impor Data Transaksi</h3>
								<p class="text-sm text-slate-600 dark:text-slate-400">Unggah file Excel dengan format kolom yang sesuai</p>
							</div>
						</div>
					</div>

					{{-- Body Section --}}
					<div class="p-6">
						<div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-4 border border-slate-200 dark:border-slate-700 mb-6">
							<h4 class="font-semibold text-slate-900 dark:text-white mb-2 flex items-center">
								<i data-lucide="info" class="w-4 h-4 mr-2 text-blue-500"></i>
								Format Kolom (heading row)
							</h4>
							<ul class="list-disc list-inside text-sm text-slate-600 dark:text-slate-400">
								<li>invoice_number (unik)</li>
								<li>invoice_date (YYYY-MM-DD)</li>
								<li>due_date (opsional, YYYY-MM-DD)</li>
								<li>type (kredit/debit)</li>
								<li>total_amount (angka)</li>
								<li>payment_status (pending/paid/canceled)</li>
								<li>customer_name (opsional)</li>
								<li>notes (opsional)</li>
							</ul>
						</div>

						<form action="{{ route('reports.financial.do_import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
							@csrf
							<div>
								<label for="file" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
									<div class="flex items-center space-x-2">
										<i data-lucide="file" class="w-4 h-4 text-blue-500"></i>
										<span>Pilih File Excel</span>
									</div>
								</label>
								<input type="file" id="file" name="file"
									class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
									required />
								<p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Format: .xlsx, .xls, .csv (maks 4MB)</p>
								@error('file')
									<p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
										<i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
										{{ $message }}
									</p>
								@enderror
							</div>

							<div class="flex items-center justify-between pt-4 border-t border-slate-200 dark:border-slate-700">
								<a href="{{ route('reports.financial') }}"
								   class="group flex items-center px-6 py-3 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-all duration-200">
									<i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
									Kembali ke Laporan
								</a>
								<button type="submit"
										class="group flex items-center px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
									<i data-lucide="upload" class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform"></i>
									Impor Data
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
