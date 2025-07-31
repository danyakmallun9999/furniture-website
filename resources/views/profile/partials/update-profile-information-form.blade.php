<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-4">
        <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Nama Lengkap
                </label>
                <input id="name" name="name" type="text" 
                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" 
                    placeholder="Masukkan nama lengkap Anda" />
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
        </div>

        <div>
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Alamat Email
                </label>
                <input id="email" name="email" type="email" 
                    class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                    value="{{ old('email', $user->email) }}" required autocomplete="username" 
                    placeholder="Masukkan alamat email Anda" />
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                        <div class="flex items-start space-x-3">
                            <div class="w-5 h-5 bg-amber-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="alert-triangle" class="w-3 h-3 text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-amber-800 dark:text-amber-200 font-medium">
                                    Email belum diverifikasi
                                </p>
                                <p class="text-sm text-amber-700 dark:text-amber-300 mt-1">
                                    Alamat email Anda belum diverifikasi. 
                                    <button form="send-verification" 
                                        class="underline text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-200 font-medium">
                                        Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-sm text-green-600 dark:text-green-400 font-medium">
                                        Link verifikasi baru telah dikirim ke alamat email Anda.
                        </p>
                    @endif
                            </div>
                        </div>
                </div>
            @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" 
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-105 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <div class="flex items-center space-x-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan Perubahan</span>
                </div>
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center space-x-2 px-4 py-2 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                    <span class="text-sm text-green-700 dark:text-green-300 font-medium">Berhasil disimpan!</span>
                </div>
            @endif
        </div>
    </form>
</section>
