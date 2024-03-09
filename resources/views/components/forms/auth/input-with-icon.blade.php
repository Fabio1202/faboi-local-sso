<div>
    <label {{ $attributes->merge(["class" => "block"]) }}>
        <span class="text-black dark:text-white">{{ $label }}</span>
        <div class="flex items-center">
            <span class="absolute w-10 overflow-hidden ml-1">
                {{ $slot }}
            </span>
            <input autocomplete="{{ $autocomplete }}" name="{{ $name }}" type="{{ $type }}" class="block h-12 rounded-md pl-11 w-full bg-gray-100 dark:bg-gray-900 border-none placeholder:text-gray-300 disabled:text-gray-500" placeholder="{{ $placeholder }}" value="{{ $value }}" {{$disabled ? "disabled" : ""}}>
        </div>
    </label>
</div>
