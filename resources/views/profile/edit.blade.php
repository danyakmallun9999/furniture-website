<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight">
                        Pengaturan Akun
                    </h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                        Kelola informasi profil dan keamanan akun Anda
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        {{-- Profile Information Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="user" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                            Informasi Profil
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            Update informasi akun dan alamat email Anda
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Password Update Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="lock" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                            Update Password
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            Pastikan akun Anda menggunakan password yang kuat dan unik
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete Account Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl overflow-hidden">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="trash-2" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">
                            Hapus Akun
                        </h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            Hapus akun Anda secara permanen. Tindakan ini tidak dapat dibatalkan
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        </script>
    @endpush
</x-app-layout>
