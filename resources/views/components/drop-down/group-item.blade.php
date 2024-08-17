<div {{ $attributes->merge(['class'=>'rounded-md w-full bg-white dark:bg-gray-800 p-5 flex justify-between']) }}>
    <div>
        {{ $title }}
        @if(isset($description))
            <p class="text-gray-400">{{ $description }}</p>
        @endif
    </div>
    <div class="flex justify-end items-center">
        {{ $slot }}
    </div>
</div>
