<x-app-layout>
    <script type="module">
        document.getElementById("passkey-start-registration").addEventListener("click", () => {
            window.registerPasskey("{{ csrf_token() }}");
        });
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button id="passkey-start-registration" class="mt-6 block w-full py-3 border-solid border-2 border-gray-300 rounded-md text-xl">
                        <i class="fa-solid fa-fingerprint mr-3"></i>
                        Create Passkey
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
