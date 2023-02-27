<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-forms.list title="Registered Users" :pagination="$users->links()">
            @slot("button")
                <a class="px-14 py-2 bg-primary text-white rounded-full" href="{{ route("users.create") }}">
                    <button class="">Add User</button>
                </a>
            @endslot
            @slot("listEntries")
                @foreach($users as $user)
                    <x-forms.list-entry :lastEntry="$loop->last">
                        @slot("h1")
                            {{ $user->name }}
                        @endslot

                        @slot("h2")
                            {{ $user->email }}
                        @endslot

                        @slot("actions")
                                @if($user->email_verified_at == null)
                                    <span class="text-yellow-600">
                                        Verification sent
                                    </span>
                                @else
                                    <span class="text-green-600">
                                        Activated
                                    </span>
                                @endif
                            <a class="text-lg ml-3" href="#">
                                <i class="fa-solid fa-pen-to-square text-2xl"></i>
                            </a>
                            <a class="text-lg ml-3 text-red-800" href="#">
                                <i class="fa-solid fa-trash text-2xl"></i>
                            </a>
                        @endslot
                    </x-forms.list-entry>
                @endforeach
            @endslot
        </x-forms.list>
    </div>
</x-app-layout>
