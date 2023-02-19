<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex justify-between items-center pb-3">
                <h1 class="font-bold text-2xl"> {{ $title }}</h1>
                {{ isset($button) ? $button : "" }}
            </div>
            <div class="mt-10">
                {{ $listEntries }}
            </div>
            <div class="mt-10">
                {!! $pagination !!}
            </div>
        </div>
    </div>
</div>
