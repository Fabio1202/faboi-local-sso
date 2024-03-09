<x-auth-layout title="Activate Account">
    <x-slot:image><img alt="" src="{{ asset('img/Sand-castle.svg') }}" class="w-2/3 object-cover"></x-slot:image>
    @if(request()->get('mail-sent') === 'true')
        <div class="mb-4 text-xl">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>
    @else
        <form class="w-full p-6" method="POST" action="{{ route('users.activate.post') }}">
            @csrf
            <x-forms.auth.input-with-icon :disabled="true" placeholder="Harvey Specter" label="Name" name="name" :value="old('name') ?? $user->name">
                <i class="fa-solid fa-user text-xl px-2 text-gray-300"></i>
            </x-forms.auth.input-with-icon>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <x-forms.auth.input-with-icon :disabled="true" :value="old('email') ?? $user->email" autocomplete="username" placeholder="specter@pearson-specter-litt.com" label="Email" name="email" type="email" class="mt-3">
                <i class="fa-solid fa-envelope text-xl px-2 text-gray-300"></i>
            </x-forms.auth.input-with-icon>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-forms.auth.input-with-icon placeholder="********" autocomplete="new-password" label="Password" name="password" type="password" class="mt-3">
                <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
            </x-forms.auth.input-with-icon>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-forms.auth.input-with-icon placeholder="********" autocomplete="new-password" label="Confirm Password" name="password_confirmation" type="password" class="mt-3">
                <i class="fa-solid fa-lock text-xl px-2 text-gray-300"></i>
            </x-forms.auth.input-with-icon>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            <input type="hidden" name="uuid" value="{{ \Illuminate\Support\Facades\Crypt::encryptString($user->uuid) }}">
            <button type="submit" class="w-1/3 bg-primary rounded-full font-bold text-white mt-10 p-2">Activate Account</button>
        </form>
    @endif
</x-auth-layout>
