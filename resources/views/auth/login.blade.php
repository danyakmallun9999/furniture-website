{{-- resources/views/auth/login-pure-tailwind.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }

        .gradient-text {
            background-image: linear-gradient(to right, #059669, #10B981);
            /* emerald-600 to emerald-500 */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="relative min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        {{-- Background Pattern (dari homepage) --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 25px 25px, #10b981 2px, transparent 0), radial-gradient(circle at 75px 75px, #059669 2px, transparent 0); background-size: 100px 100px;">
            </div>
        </div>

        <div
            class="relative z-10 w-full max-w-4xl flex flex-col md:flex-row bg-white rounded-2xl border border-gray-200 overflow-hidden animate-fade-in-up">
            {{-- Left Side: Image --}}
            <div class="hidden md:block md:w-1/2 bg-gray-100 flex-shrink-0">
                <img src="{{ asset('img/login-furniture.jpg') }}" alt="Desain Interior Modern"
                    class="w-full h-full object-cover">
            </div>

            {{-- Right Side: Login Form --}}
            <div class="w-full md:w-1/2 p-10 space-y-8 flex flex-col justify-center">
                <div class="text-center">
                    <a href="{{ route('homepage') }}" class="inline-block mb-6">
                        <h1 class="text-4xl font-bold gradient-text">Login Admin Furniture</h1>
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">
                        Masuk ke Akun Anda
                    </h2>
                    <p class="mt-2 text-base text-gray-600">
                        Selamat datang kembali! Silakan masuk untuk melanjutkan.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-4 text-center text-sm font-medium text-emerald-700 bg-emerald-50 p-3 rounded-md">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <input id="email"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                            type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username" placeholder="Masukkan alamat email Anda">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                        <input id="password"
                            class="block w-full px-4 py-2 border border-gray-300 rounded-xl placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan kata sandi Anda">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-lg font-semibold text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-300 transform hover:scale-105">
                            Masuk
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
