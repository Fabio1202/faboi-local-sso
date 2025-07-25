<x-guest-layout>
    <div class="flex w-screen">
        <div class="w-screen overflow-hidden bg-white min-h-screen md:w-2/5 md:px-12 dark:bg-gray-800 dark:text-white">
            <div class="mt-10 w-full flex justify-center flex-wrap">
                <div class="w-52">
                    <x-application-logo/>
                </div>
            </div>
            <h1 class="font-bold text-6xl px-4 md:px-0 pb-5 pt-14">{{ $title }}</h1>
            {{ $slot }}
        </div>
        <div class="hidden md:flex w-3/5 h-screen justify-center items-center content-center bg-gray-100 dark:bg-gray-900">
            {{ $image }}
        </div>
    </div>
</x-guest-layout>
