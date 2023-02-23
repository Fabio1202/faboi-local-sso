<x-auth-layout title="Update password">
    <form class="w-full p-6" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-forms.auth.input-with-icon label="E-Mail" name="email" placeholder="lily@ahoi.com" type="email">
            <i class="fa-solid fa-user text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <x-forms.auth.input-with-icon label="Password" name="password" placeholder="********" type="password" class="mt-3">
            <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        <x-forms.auth.input-with-icon label="Confirm Password" name="password_confirmation" placeholder="********" type="password" class="mt-3">
            <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
        </x-forms.auth.input-with-icon>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        <button type="submit" class="w-1/3 bg-primary rounded-full font-bold text-white mt-10 p-2">Update Password</button>
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

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

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
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
--}}
