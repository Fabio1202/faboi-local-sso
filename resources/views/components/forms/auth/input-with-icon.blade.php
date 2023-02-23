<div>
    <label {{ $attributes->merge(["class" => "block"]) }}>
        <span class="text-black dark:text-white">{{ $label }}</span>
        <div class="flex w-full rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-900 content-center items-center h-12">
            {{ $slot }}
            <input name="{{ $name }}" type="{{ $type }}" class="h-full w-full outline-0 outline-none outline-0 bg-gray-100 dark:bg-gray-900 border-none placeholder:text-gray-300" placeholder="{{ $placeholder }}">
        </div>
    </label>
</div>
