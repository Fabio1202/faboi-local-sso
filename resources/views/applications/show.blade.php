<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-card-view>
            <h1 class="font-bold text-6xl flex items-start">
                {{ $application->name }}

                @if($application->first_party)
                    <i class="fa-solid fa-asterisk text-2xl"></i>
                @endif
            </h1>
            <table class="w-full mt-5">
                <tr>
                    <td class="font-bold w-1/6">ID</td>
                    <td>{{ $application->id }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Owner</td>
                    <td>{{ $application->owner->name }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Created At</td>
                    <td>{{ $application->created_at }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Updated At</td>
                    <td>{{ $application->updated_at }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Description</td>
                    <td>{{ $application->description }}</td>
                </tr>
            </table>
        </x-card-view>

        <x-forms.list title="Associated Clients" pagination="" class="mt-5">
            <x-slot name="listEntries">
                @if($application->clients->count() > 0)
                    @foreach($application->clients as $client)
                        <x-forms.list-entry :lastEntry="$loop->last">
                            @slot("h1")
                                {{ $client->name }}
                            @endslot

                            @slot("actions")
                                <div class="flex">
                                    <a href="{{ '#' }}" class="h-full inline-block">
                                        <span><i class="fa-solid fa-edit text-xl"></i></span>
                                    </a>
                                    <form action="{{ route("clients.destroy", $client) }}" method="POST" class="ml-3 block h-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 block">
                                            <i class="fa-solid fa-trash text-xl"></i>
                                        </button>
                                    </form>
                                </div>
                            @endslot

                            <x-slot name="h2">
                                <span class="text-gray-400 font-normal">ID: </span>{{ $client->id }}
                            </x-slot>
                        </x-forms.list-entry>
                    @endforeach
                    @else
                    <x-forms.list-entry :lastEntry="true">
                        <x-slot name="h1">
                            <span class="text-gray-400 font-normal">
                                There are currently no clients associated to this application.</span>
                        </x-slot>
                    </x-forms.list-entry>
                    @endif
            </x-slot>
            <x-slot:button>
                <a class="px-14 py-2 bg-blue-800 text-white rounded-full" href="{{ route("clients.create", $application) }}">
                    <button class="">Add Client</button>
                </a>
            </x-slot:button>
        </x-forms.list>
    </div>
</x-app-layout>
