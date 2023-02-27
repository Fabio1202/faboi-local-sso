<x-auth-layout title="Email Verification">
    <x-slot name="image">

    </x-slot>

    <div class="mb-4 text-xl">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    <div class="mt-4 overflow-hidden h-20 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" class="w-2/3 p-3 h-10 block">
            @csrf

            <div>
                <button type="submit" class=" py-3 bg-primary rounded-md w-full h-full">{{ __('Resend Verification Email') }}</button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}"  class="w-1/3 p-3 h-10 block">
            @csrf

            <div>
                <button type="submit" class=" py-3 underline rounded-md w-full h-full">{{ __('Log out') }}</button>
            </div>
        </form>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-3 mb-4 font-medium text-md text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif
</x-auth-layout>
{{--

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
--}}
