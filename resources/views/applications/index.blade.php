<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-forms.list title="Registered Applications" :pagination="$applications->links()">
            @slot("button")
                <a class="px-14 py-2 bg-blue-800 text-white rounded-full" href="{{ route('applications.create') }}">
                    <button class="">Add Application</button>
                </a>
            @endslot
            @slot("listEntries")
                @foreach($applications as $application)
                    <x-forms.list-entry :lastEntry="$loop->last">
                        @slot("h1")
                            {{ $application->name }}
                        @endslot

                        @slot("h2")
                            {{ $application->getShortDescriptionAttribute() }}
                        @endslot

                        @slot("actions")
                            <a href="{{ route('applications.show', $application) }}">
                                <span><i class="fa-solid fa-edit text-xl"></i></span>
                            </a>
                        @endslot
                    </x-forms.list-entry>
                @endforeach
            @endslot
        </x-forms.list>
    </div>
</x-app-layout>
