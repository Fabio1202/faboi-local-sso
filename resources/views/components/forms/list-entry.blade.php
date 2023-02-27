<div class="pt-3 flex justify-between items-center {{ $lastEntry ? "" : "pb-3 border-b-2 border-b-gray-100 dark:border-b-gray-700" }}">
    <div>
        <h1 class="font-bold text-lg">{{ $h1 }}</h1>
        @if(isset($h2))
            <h2 class="text-sm">{{ $h2 }}</h2>
        @endif
    </div>
    <div class="">
        {{ isset($actions) ? $actions : '' }}
    </div>
</div>
