<x-auth-layout :title="__('Welcome') . '!'">
    <form class="w-full p-6" method="POST" action="{{ route('login') }}">
        @csrf
        <x-forms.auth.input-with-icon label="E-Mail" name="email" placeholder="big.fudge@gnb.com" type="email" autofocus>
            <i class="fa-solid fa-user text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <x-forms.auth.input-with-icon label="Password" name="password" placeholder="********" type="password" class="mt-4">
            <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <button type="submit" class="w-1/3 bg-primary rounded-full font-bold text-white mt-10 p-2">Log In</button>
        <a href="{{ route('password.request') }}">
            <span class="mt-4 inline-block text-black dark:text-white w-full">Forgot your password?</span>
        </a>
    </form>
    <x-slot name="image">
        <img alt="" src="{{ asset('img/Fingerprint-Authentication.svg') }}" class="w-2/3 object-cover">
    </x-slot>
</x-auth-layout>
        {{--<form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>--}}
