<div>
    <x-card-view>
        <h1 class="text-3xl font-bold">Create Role</h1>
        <div class="mt-6">
            <x-forms.text-input required title="Name" name="name" placeholder="Admin" value="{{ $role->name }}" />
            <x-forms.text-input title="Description" name="description" placeholder="This is the basic admin role." class="mt-5" value="{{ $role->description }}"/>
        </div>
    </x-card-view>

    <x-card-view class="mt-6">
        <h1 class="text-xl font-bold">Permissions</h1>
        @foreach($applications as $app)
            <x-drop-down.group-extend class="{{ $loop->last ? '' : 'mb-3' }}">
                <x-slot name="title">
                    {{ $app->name }}
                </x-slot>

                @foreach($app->permissionGroups as $permGroup)
                    <h2 class="p-1 font-lg font-bold">{{ $permGroup->name }}</h2>
                    @foreach($permGroup->permissions as $permission)
                        <label>
                            <x-drop-down.group-item class="border-b-[4px] border-gray-100 dark:border-gray-900">
                                <x-slot:title>
                                    {{ $permission->name }}
                                </x-slot:title>
                                <x-slot:description>
                                    {{ $permission->description }}
                                </x-slot:description>

                                <input type="checkbox" class="h-8 w-8 bg-gray-200 dark:bg-gray-700 border-none rounded-md" name="permissions[]" value="{{ $permission->id }}" {{ $role->permissions->contains($permission) ? "checked" : "" }}/>
                            </x-drop-down.group-item>
                        </label>
                    @endforeach
                @endforeach
            </x-drop-down.group-extend>
        @endforeach
    </x-card-view>

    <x-forms.list  class="mt-6">
        <x-slot:title>Users</x-slot:title>

        <x-slot:pagination>
            {{ $users->links() }}
        </x-slot:pagination>

        <x-slot:listEntries>
            @foreach($users as $user)
                <label>
                    <x-forms.list-entry :last-entry="$loop->last">
                        <x-slot:h1>
                            {{ $user->name }}
                        </x-slot:h1>
                        <x-slot:h2>
                            {{ $user->email }}
                        </x-slot:h2>
                        <x-slot:actions>
                            <input type="checkbox" class="h-8 w-8 bg-gray-200 dark:bg-gray-700 border-none rounded-md" name="users[]" value="{{ $user->id }}" {{ $role->users->contains($user) ? "checked" : "" }}/>
                        </x-slot:actions>
                    </x-forms.list-entry>
                </label>
            @endforeach
        </x-slot:listEntries>
    </x-forms.list>
</div>
