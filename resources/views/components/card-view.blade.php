<div {{ $attributes->merge(["class" => " max-w-7xl mx-auto sm:px-6 lg:px-8"]) }}>
    <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 dark:text-white">
            {{ $slot }}
        </div>
    </div>
</div>
