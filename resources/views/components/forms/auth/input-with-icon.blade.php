<div>
    <label {{ $attributes->merge(["class" => "block"]) }}>
        <span class="text-black dark:text-white">{{ $label }}</span>
        <div class="flex items-center">
            <span class="absolute w-10 overflow-hidden ml-1">
                {{ $slot }}
            </span>
            <input name="{{ $name }}" type="{{ $type }}" class="block h-12 rounded-md pl-11 w-full bg-gray-100 dark:bg-gray-900 border-none placeholder:text-gray-300" placeholder="{{ $placeholder }}" value="{{ $value }}">
        </div>
    </label>
</div>
