<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center my-6">
        <h2 class="text-3xl font-semibold text-gray-900 text-center tracking-wide">Masuk</h2>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-[#24937E] shadow-sm focus:ring-[#0E5D4E]" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Biarkan saya tetap masuk') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0E5D4E]"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="w-full flex items-center justify-center my-6">
            <x-primary-button class="w-full">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mb-2 text-center text-sm text-gray-600">
        Belum punya akun?
        <a class="text-[#24937E] hover:text-[#0E5D4E] font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0E5D4E]"
            href="{{ route('register') }}">
            {{ __('Daftar') }}
        </a>
    </div>
</x-guest-layout>
