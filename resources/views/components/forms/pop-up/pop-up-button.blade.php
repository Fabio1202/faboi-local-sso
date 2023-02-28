<div x-data="{ show: false}">

    <button @click="show = true" {{ $attributes->merge(['class' => 'cursor-pointer'])  }}>
        {{ $trigger }}
    </button>

    <div x-show="show" x-cloak class="fixed top-0 left-0 w-screen h-screen flex items-center content-center justify-center">
        <div x-cloak class="bg-black opacity-40 w-full h-full fixed z-0" @click="show = false"></div>
        <div x-cloak class="relative z-10">
            {{ $slot }}
        </div>
    </div>
</div>
