<section>
    <div class="space-y-6">
        <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
            <div class="flex items-start space-x-3">
                <div class="w-5 h-5 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                    <i data-lucide="alert-triangle" class="w-3 h-3 text-white"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                        Hapus Akun Secara Permanen
                    </h3>
                    <p class="text-sm text-red-700 dark:text-red-300 mt-1">
                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. 
                        Sebelum menghapus akun Anda, harap unduh data atau informasi yang ingin Anda simpan.
        </p>
                </div>
            </div>
        </div>

        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
            @csrf
            @method('delete')

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Password Konfirmasi
                </label>
                <input id="password" name="password" type="password" 
                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200" 
                    required autocomplete="current-password" 
                    placeholder="Masukkan password untuk konfirmasi" />
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit" 
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.')">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        <span>Hapus Akun</span>
                    </div>
                </button>
            </div>
        </form>
    </div>
</section>
