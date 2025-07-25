<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __("Users ") }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="py-12">
            <x-users.show-user :user="new \App\Models\User()"></x-users.show-user>
            <x-card-view class="mt-6">
                <x-primary-button>
                    {{ __('Create User') }}
                </x-primary-button>
            </x-card-view>
        </div>
    </form>
</x-app-layout>
