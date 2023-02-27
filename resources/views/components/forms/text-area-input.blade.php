<div {{ $attributes }}>
    <label>
        <span class="text-gray-700 dark:text-white">{{ $title }}</span>
        <textarea id="{{ $name . "-textarea"}}" name="{{ $name }}" placeholder="{{ isset($placeholder) ? $placeholder : "" }}" class="placeholder:text-gray-400 border-none rounded-md bg-gray-200 dark:bg-gray-700 w-full" >{{ $value }}</textarea>
    </label>

    @if($preventNewLines)
        <script>
            document.getElementById("{{ $name . "-textarea"}}").addEventListener("keydown", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                }
            });
        </script>
    @endif
</div>
