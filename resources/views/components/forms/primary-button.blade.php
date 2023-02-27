<div>
    <a {{ $attributes->merge(["class" => "inline-block px-14 py-2 bg-primary text-white rounded-full"]) }} href="{{ $route }}">
        <button class="">{{ $slot }}</button>
    </a>
</div>
