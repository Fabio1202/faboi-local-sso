<div {{ $attributes->merge(['class'=>'rounded-md w-full bg-white dark:bg-gray-800 p-5']) }}>
    {{ $title }}
    @if(isset($description))
        <p class="text-gray-400">{{ $description }}</p>
    @endif
</div>
