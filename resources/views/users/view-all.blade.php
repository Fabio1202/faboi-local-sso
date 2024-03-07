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
                            <span class="flex items-center gap-1.5">
                                <span class="text-[0.5rem] inline-flex content-center items-center justify-center w-4 h-4 rounded-full overflow-hidden text-white">
                                    @if($user->email_verified_at == null)
                                        <span title="E-Mail not verified" class="bg-yellow-600 w-full h-full flex justify-center items-center"><i class="fa-solid fa-hourglass-half"></i></span>
                                    @else
                                        <span title="E-Mail verified" class="bg-green-800 w-full h-full flex justify-center items-center"><i class="fa-solid fa-check"></i></span>
                                    @endif
                                </span>
                                <span>
                                    {{ $user->name }}
                                </span>
                            </span>
                        @endslot

                        @slot("h2")
                            {{ $user->email }}
                        @endslot

                        @slot("actions")
                            <a class="text-lg ml-3" href="#">
                                <i class="fa-solid fa-pen-to-square text-xl"></i>
                            </a>
                            <a class="text-lg ml-2 text-red-800" href="#">
                                <i class="fa-solid fa-trash text-xl"></i>
                            </a>
                        @endslot
                    </x-forms.list-entry>
                @endforeach
            @endslot
        </x-forms.list>
    </div>
</x-app-layout>
