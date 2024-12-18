<x-guest-layout>
        <div class="text-center mb-6 mt-4">
            <h1 class="text-2xl font-bold text-gray-700">Forget Password?</h1>
            <p class="text-gray-500">Please enter your email</p>
        </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Request Password') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Back to Login Link -->
    <div class="mt-4 text-right">
        <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:text-blue-700 mb-4">
            {{ __('Back to Login') }}
        </a>
    </div>
</x-guest-layout>

