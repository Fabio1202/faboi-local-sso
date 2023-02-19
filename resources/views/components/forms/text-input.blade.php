<div {{ $attributes }}>
    <label>
        <span class="text-gray-700">{{ $title }}</span>
        <input type="{{ isset($type) ? $type : "text" }}" name="{{ $name }}" placeholder="{{ isset($placeholder) ? $placeholder : "" }}" class="placeholder:text-gray-400 p-2 rounded-lg w-full">
    </label>
</div>
