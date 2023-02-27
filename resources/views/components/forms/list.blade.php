<x-card-view {{ $attributes }}>
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
</x-card-view>
