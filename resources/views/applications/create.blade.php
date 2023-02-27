<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot:header>

    <div class="py-12">
        <x-card-view>
            <h1 class="text-2xl font-bold">Create Application</h1>
            <form class="mt-5 px-5" method="POST" action="{{ route("applications.store") }}">
                @csrf
                <x-forms.text-input :value="old('name')" name="name" title="Name" placeholder="SlapCountdown" />
                <x-input-error :messages="$errors->get('name')"></x-input-error>
                <x-forms.text-area-input :value="old('description')" prevent-new-lines name="description" title="Description" placeholder="A simple countdown timer for Slap" class="mt-3" />
                <x-input-error :messages="$errors->get('description')"></x-input-error>
                <label class="flex content-center items-center mt-3">
                    <input {{ old('first_party') == "on" ? "checked" : "" }} type="checkbox" class="h-8 w-8 bg-gray-200 dark:bg-gray-700 border-none rounded-md" name="first_party"/>
                    <span class="inline-block ml-3">First Party Application</span>
                </label>
                <x-input-error :messages="$errors->get('first_party')"></x-input-error>
                <x-forms.primary-button :route="'#'" class="mt-6">Create Application</x-forms.primary-button>
            </form>
        </x-card-view>
    </div>
</x-app-layout>
