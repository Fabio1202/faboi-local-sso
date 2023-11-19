<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Roles
        </h2>
    </x-slot>
<form method="POST" action="{{ route('roles.store') }}">
    @csrf
    <div class="py-12">
        <x-card-view>
            <h1 class="text-3xl font-bold">Create Role</h1>
            <div class="mt-6">
                    <x-forms.text-input required title="Name" name="name" placeholder="Admin" />
                    <x-forms.text-input title="Description" name="desc" placeholder="This is the basic admin role." class="mt-5"/>
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

                                <input type="checkbox" class="h-8 w-8 bg-gray-200 dark:bg-gray-700 border-none rounded-md" name="permissions[]" value="{{ $permission->id }}"/>
                            </x-drop-down.group-item>
                            </label>
                        @endforeach
                    @endforeach
                </x-drop-down.group-extend>
            @endforeach
        </x-card-view>

        <x-card-view class="mt-6">
            <x-primary-button>
                Create Role
            </x-primary-button>
        </x-card-view>
    </div>
</form>
</x-app-layout>
