<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded  border-customerGreen-700 text-customerGreen-700 shadow-sm focus:ring-cusotmerGreen-700 dark:focus:ring-customerGreen-600 dark:focus:ring-offset-customerGreen-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Souviens-toi de moi') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-customerGreen-700 dark:text-customerGreen-400 hover:text-customerGreen-500 dark:hover:text-customerGreen-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-customerGreen-700 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Mot de passe oublié?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>