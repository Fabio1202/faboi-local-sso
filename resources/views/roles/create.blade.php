<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles
        </h2>
    </x-slot>
<form method="POST" action="{{ route('roles.store') }}">
    @csrf
    <div class="py-12">
        <x-roles.show-role :role="$role" :applications="$applications"/>

        <x-card-view class="mt-6">
            <x-primary-button>
                Create Role
            </x-primary-button>
        </x-card-view>
    </div>
</form>
</x-app-layout>
