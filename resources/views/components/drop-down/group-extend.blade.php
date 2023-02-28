<div x-data="{ show: false }" {{ $attributes->merge(['class' => 'bg-gray-100 dark:bg-gray-900 rounded-md border-[6px] border-gray-100 dark:border-gray-900']) }}>
    <div @click="show = !show" class="cursor-pointer w-full flex items-center justify-between p-5">
        <div>
            <h1 class="text-lg font-bold">{{ $title }}</h1>
            @if(isset($description))
                <p class="text-gray-400">{{ $description }}</p>
            @endif
        </div>
        <i x-show="!show" class="fa-solid fa-plus"></i>
        <i x-show="show" x-cloak class="fa-solid fa-minus"></i>
    </div>

    <div class="w-full" x-cloak x-show="show">
        {{ $slot }}
    </div>
</div>
