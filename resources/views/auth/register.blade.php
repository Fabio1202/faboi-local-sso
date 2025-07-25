<x-auth-layout title="Register">
    <x-slot name="image">

    </x-slot>

    <form class="w-full p-6" action="{{ route('register.post') }}" method="POST">
        @csrf
        <x-forms.auth.input-with-icon placeholder="Harvey Specter" label="Name" name="name" >
            <i class="fa-solid fa-user text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="old('name')" class="mt-2" />
        <x-forms.auth.input-with-icon placeholder="specter@pearson-specter-litt.com" label="Email" name="email" type="email" class="mt-3">
            <i class="fa-solid fa-envelope text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <x-forms.auth.input-with-icon placeholder="********" label="Password" name="password" type="password" class="mt-3">
            <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <x-forms.auth.input-with-icon placeholder="********" label="Confirm Password" name="password_confirmation" type="password" class="mt-3">
            <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        <button type="submit" class="w-1/3 bg-primary rounded-full font-bold text-white mt-10 p-2">Register</button>
    </form>
</x-auth-layout>

{{--
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
--}}
