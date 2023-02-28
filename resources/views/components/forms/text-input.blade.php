<div {{ $attributes }}>
    <label>
        <span class="text-gray-700 dark:text-white">{{ $title }}</span>
        <input type="{{ isset($type) ? $type : "text" }}" name="{{ $name }}" placeholder="{{ isset($placeholder) ? $placeholder : "" }}" value="{{ $value }}" {{ ($readonly ?? false) ? "disabled" : "" }} class="placeholder:text-gray-400 border-none rounded-md bg-gray-200 dark:bg-gray-700 w-full">
    </label>
</div>
