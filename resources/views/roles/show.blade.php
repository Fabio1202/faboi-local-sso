<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('roles.update', ['role' => $role]) }}">
        @csrf
        <div class="py-12">
            <x-roles.show-role :role="$role" :applications="$applications" :users="$users"/>

            <x-card-view class="mt-6">
                <x-primary-button>
                    Update Role
                </x-primary-button>
            </x-card-view>
        </div>
    </form>
</x-app-layout>
