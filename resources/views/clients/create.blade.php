<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card-view>
            <h1 class="font-bold text-2xl pb-5">Create Client</h1>
            <form method="POST" action="{{ route('clients.store') }}">
                @csrf
                <input type="hidden" name="application_id" value="{{ $application->id }}">
                <x-forms.text-input :value="old('name')" name="name" title="Name" placeholder="SlapCountdown" />
                <x-input-error :messages="$errors->get('name')"></x-input-error>
                <x-forms.text-input :value="old('redirect')" name="redirect" title="Redirect URI" placeholder="https://slapcountdown.com/callback" class="mt-3" />
                <x-input-error :messages="$errors->get('redirect')"></x-input-error>
                <h2 class="mt-5 mb-1 text-xl font-bold">Select the type of the client:</h2>
                <label class="flex items-center">
                    <input type="radio" name="type" value="password" class="h-5 w-5 bg-gray-200 dark:bg-gray-700 border-none">
                    <span class="ml-3 text-lg">Password</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="type" value="authorization" checked class="h-5 w-5 bg-gray-200 dark:bg-gray-700 border-none">
                    <span class="ml-3 text-lg">Authorization</span>
                </label>
                <x-input-error :messages="$errors->get('type')"></x-input-error>
                <x-forms.primary-button :route="'#'" class="mt-6">Create Client</x-forms.primary-button>
            </form>
        </x-card-view>
    </div>
</x-app-layout>
