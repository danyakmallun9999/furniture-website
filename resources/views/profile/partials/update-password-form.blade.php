<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-4">
        <div>
                <label for="current_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Password Saat Ini
                </label>
                <input id="current_password" name="current_password" type="password" 
                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                    required autocomplete="current-password" 
                    placeholder="Masukkan password saat ini" />
                @error('current_password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
        </div>

        <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Password Baru
                </label>
                <input id="password" name="password" type="password" 
                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                    required autocomplete="new-password" 
                    placeholder="Masukkan password baru" />
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
        </div>

        <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Konfirmasi Password Baru
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" 
                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200" 
                    required autocomplete="new-password" 
                    placeholder="Konfirmasi password baru" />
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                <div class="flex items-center space-x-2">
                    <i data-lucide="key" class="w-4 h-4"></i>
                    <span>Update Password</span>
                </div>
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center space-x-2 px-4 py-2 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                    <span class="text-sm text-green-700 dark:text-green-300 font-medium">Password berhasil diupdate!</span>
                </div>
            @endif
        </div>
    </form>
</section>
