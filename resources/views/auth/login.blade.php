
<x-guest-layout>
<body class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg">
        <div class="text-center mb-6">
            <img src="{{ asset('images/logobinabhs.png') }}" alt="Logo" class=" w-20 mx-auto">
            <h1 class="text-2xl font-bold text-gray-700">Selamat Datang!</h1>
            <p class="text-gray-500">Masuk untuk melanjutkan.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email" :value="old('email')" required autofocus autocomplete="username"
                    class="input input-bordered w-full">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi" required autocomplete="current-password"
                        class="input input-bordered w-full pr-10">
                    <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12h.01m-6.01 0h.01m2 0a2 2 0 100-4 2 2 0 000 4zm6 4a4 4 0 01-8 0m2-3h4"></path>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>
            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="mb-4 text-right">
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">Lupa kata sandi?</a>
                </div>
            @endif

            <!-- Login Button -->
            <button type="submit" class="btn btn-primary w-full bg-blue-500 text-white text-base py-3 px-4 rounded-md">Masuk</button>

            <!-- Divider -->
            <div class="divider my-3 text-center text-gray-500 text-xs">ATAU</div>

            <!-- Login with Google -->
            <button type="button" class="btn w-full bg-blue-500 text-white text-base flex items-center justify-center py-3 px-4 rounded-md">
                <div class="w-5 h-5 mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                        <path d="M12 11.88v4.24h5.94c-.87 2.58-3.27 4.38-5.94 4.38-3.4 0-6.16-2.76-6.16-6.16s2.76-6.16 6.16-6.16c1.5 0 2.87.54 3.95 1.44l3.04-3.04C17.3 3.8 14.82 2.62 12 2.62c-5.17 0-9.38 4.21-9.38 9.38s4.21 9.38 9.38 9.38c5.17 0 8.62-3.62 8.62-8.62 0-.58-.06-1.14-.18-1.68H12z"/>
                    </svg>
                </div>
                Masuk dengan Google
            </button>

            <!-- Forgot Password -->
            @if (Route::has('register'))
                <div class="mb-8 mt-3 text-right">
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">Belum punya akun?</a>
                </div>
            @endif

        </form>


        <footer class="mt-6 text-center text-sm text-gray-500">
            &copy; 2024 BinaBahasa
        </footer>
    </div>

    </x-guest-layout>
