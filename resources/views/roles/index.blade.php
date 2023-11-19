<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles
        </h2>
    </x-slot>

    <div class="py-12">
        <x-forms.list title="Available Roles" :pagination="$roles->links()">
            @slot("button")
                <a class="px-14 py-2 bg-primary text-white rounded-full" href="{{ route("users.create") }}">
                    <button class="">Add Role</button>
                </a>
            @endslot
            @slot('listEntries')
                @foreach($roles as $role)
                    <x-forms.list-entry :lastEntry="$loop->last">
                        @slot('h1')
                            {{ $role->name }}
                        @endslot

                        @slot('h2')
                            {{ $role->description }}
                        @endslot

                        @slot('actions')

                        @endslot
                    </x-forms.list-entry>
                @endforeach
            @endslot
        </x-forms.list>
    </div>
</x-app-layout>
