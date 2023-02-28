<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card-view>
            <h1 class="font-bold text-2xl pb-5">Client Secret</h1>
            <p class="text-lg">This is the secret of the client. It is only shown once, so make sure to copy it now.</p>
            <x-forms.text-input :value="$client->id" name="secret" title="Client-ID" placeholder="SlapCountdown" readonly />
            <x-forms.text-input :value="$client->plainSecret" name="secret" title="Client-Secret" placeholder="SlapCountdown" readonly />
        </x-card-view>
    </div>
</x-app-layout>
