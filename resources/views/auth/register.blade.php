<x-guest-layout>
    <div class="max-w-lg mx-auto p-8 bg-white rounded-lg">
        <div class="text-center mb-6">
            <img src="/path/to/logo.png" alt="Logo" class="w-16 mx-auto">
            <h1 class="text-2xl font-bold text-gray-700">Register</h1>
            <p class="text-gray-500">Buat akun untuk masuk.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                       class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input id="password" name="password" type="password" required
                       class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Already Registered -->
            <div class="text-right mt-4">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">
                    Sudah memiliki akun? Login
                </a>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit"
                        class="btn w-full bg-blue-500 border-blue-500 hover:bg-blue-600 hover:border-blue-600 text-white text-base py-3 px-4 rounded-md">
                    Register
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
