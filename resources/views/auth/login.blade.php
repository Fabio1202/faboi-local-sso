<x-guest-layout>
        <div class="flex w-screen">
            <div class="w-screen overflow-hidden bg-white min-h-screen md:w-1/3">
                <div class="mt-10 w-full flex justify-center flex-wrap">
                    <x-application-logo class="w-20 h-20 fill-current text-primary"/>
                </div>
                <form class="w-full p-6" method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>
                        <span class="text-black">E-Mail</span>
                        <div class="flex w-full rounded-lg overflow-hidden border-2 border-black  content-center items-center">
                            <i class="fa-solid fa-user text-xl px-2 text-gray-300"></i>
                            <input name="email" type="email" class="w-full bg-white border-none placeholder:text-gray-300" placeholder="big.fudge@gnb.com">
                        </div>
                    </label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <label class="block mt-3">
                        <span class="text-black mt-3">Password</span>
                        <div class="flex w-full rounded-lg overflow-hidden border-2 border-black content-center items-center">
                            <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
                            <input name="password" type="password" class="w-full bg-white border-none placeholder:text-gray-300" placeholder="**********">
                        </div>
                    </label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <button type="submit" class="w-full bg-primary text-white mt-10 p-2">Log In</button>
                    <a href="{{ route('password.request') }}">
                        <span class="mt-2 inline-block text-black">Forgot your password?</span>
                    </a>
                </form>
            </div>
            <div class="hidden md:block w-2/3 h-screen bg-primary">

            </div>
        </div>


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
</x-guest-layout>
