<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
        @csrf
        <div class="py-12">
            <x-users.show-user :user="$user"></x-users.show-user>
            <x-card-view class="mt-6">
                <x-primary-button>
                    {{  ('Update User') }}
                </x-primary-button>
            </x-card-view>
        </div>
    </form>
</x-app-layout>
