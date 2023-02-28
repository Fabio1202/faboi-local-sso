<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
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
                                    <x-forms.pop-up.pop-up-button class="ml-3">
                                        @slot("trigger")
                                            <i class="fa-solid fa-trash text-xl text-red-500"></i>
                                        @endslot

                                        <x-forms.pop-up.card>
                                            <h1 class="font-bold text-2xl">Confirm Delete</h1>
                                            <p class="my-6 text-lg">Are you sure that you want to delete the Client '{{ $client->name }}'?</p>
                                            <form action="{{ route("clients.destroy", $client) }}" method="POST" class="block h-full flex justify-around w-full">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-400 dark:bg-red-700 w-1/3 border-none p-3 rounded-md">
                                                    Delete
                                                </button>
                                                <button type="button" class="w-1/3 border-none p-3 rounded-md" @click="show = false">
                                                    Cancel
                                                </button>
                                            </form>
                                        </x-forms.pop-up.card>
                                    </x-forms.pop-up.pop-up-button>
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

        @if($application->uses_role_system)
            <x-card-view class="mt-5">
                <h1 class="font-bold text-2xl flex items-start">
                    Associated Permissions
                </h1>
                @foreach($application->permissionGroups as $permGroup)
                    <x-drop-down.group-extend class="mt-3">
                        <x-slot:title>
                            {{ $permGroup->name }}
                        </x-slot:title>

                        <x-slot:description>
                            {{ $permGroup->description }}
                        </x-slot:description>

                        @foreach($permGroup->permissions as $permission)
                            <x-drop-down.group-item class="border-b-[4px] border-gray-100 dark:border-gray-900">
                                <x-slot:title>
                                    {{ $permission->name }}
                                </x-slot:title>
                                <x-slot:description>
                                    {{ $permission->description }}
                                </x-slot:description>
                            </x-drop-down.group-item>
                        @endforeach
                        <div class="flex">
                            <div class="border-r-[2px] border-gray-100 w-1/3 rounded-md px-5 py-3 flex justify-start bg-white dark:bg-gray-800 items-center content-center cursor-pointer">
                                <i class="fa-solid fa-plus rounded-full border-dashed border-2 border-gray-300 dark:border-gray-600 p-3"></i>
                                <h1 class="ml-3 text-lg font-bold">New Permission</h1>
                            </div>
                            <div class="border-l-[2px] border-r-[2px] border-gray-100 w-1/3 rounded-md px-5 py-3 flex justify-start bg-white dark:bg-gray-800 items-center content-center cursor-pointer">
                                <i class="fa-solid fa-pencil rounded-full border-dashed border-2 border-gray-300 dark:border-gray-600 p-3"></i>
                                <h1 class="ml-3 text-lg font-bold">Edit Group</h1>
                            </div>
                            <div class="border-l-[2px] border-gray-100 w-1/3 rounded-md px-5 py-3 flex justify-start bg-white dark:bg-gray-800 items-center content-center cursor-pointer">
                                <i class="fa-solid fa-trash rounded-full border-dashed border-2 border-gray-300 dark:border-gray-600 p-3"></i>
                                <h1 class="ml-3 text-lg font-bold">Delete Group</h1>
                            </div>
                        </div>
                    </x-drop-down.group-extend>
                @endforeach
                <div class="rounded-md p-5 mt-3 flex justify-start bg-gray-100 dark:bg-gray-900 items-center content-center cursor-pointer">
                    <i class="fa-solid fa-plus rounded-full border-dashed border-2 border-gray-300 dark:border-gray-600 p-3"></i>
                    <h1 class="ml-3 text-lg font-bold">New Permission group</h1>
                </div>
            </x-card-view>
        @endif
    </div>
</x-app-layout>
