<div>
        <x-card-view>
            <div class="flex justify-between items-center pb-3">
                <h1 class="font-bold text-2xl"> Create User</h1>
            </div>
            <div class="p-6">
                <x-forms.text-input title="Name" name="name" placeholder="Ted Mosby" :value="old('name') == '' ? $user->name : old('name')"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                <x-forms.text-input title="E-Mail" name="email" placeholder="big.fudge@gnb.com" class="mt-3" :value="old('email') == null ? $user->email : old('name')"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                @if($user->id)
                    <x-primary-button class="mt-5 bg-gray-100">{{ __("Reset password") }}</x-primary-button>
                @endif
            </div>
        </x-card-view>

    @if($user->id !== null && $user->email_verified_at === null)
        <x-card-view class="mt-6">
            <h1 class="text-xl font-bold">Activation Status</h1>
            <div class="">
                <span class="mt-3 block">
                    <span class="text-white p-2 rounded-full h-8 w-8 inline-flex justify-center items-center content-center {{ $user->password === null ? "bg-yellow-500" : "bg-green-500" }}"><i class="fa-regular fa-lock"></i></span>
                    <span class="ml-3">Account{{ $user->password === null ? " not" : "" }} activated</span>
                </span>
                <span class="mt-3 block">
                    <i class="text-white fa-regular fa-envelope p-2 rounded-full aspect-square bg-yellow-500"></i>
                    <span class="ml-3">E-Mail not verified</span>
                </span>
            </div>
            <hr class="my-5 border-gray-900 border-t-2">
            <div class="rounded-md flex justify-center items-center overflow-hidden">
                @php
                    $activationLink = \Illuminate\Support\Facades\URL::temporarySignedRoute('users.activate', now()->addDays(1), ['uuid' => $user->uuid]);
                @endphp
{{--                <input value="http://localhost/register?uuid=ae786b45-89a6-4de7-93c5-4e1db106a1f5&signature=44a7157b6808e89cafa476adf427acf419fb4f3389860844a9b8d3e90bb982eb" type="text" disabled class="placeholder:text-gray-400 p-2 border-none w-full">--}}
                <x-forms.text-input title="" name="activation_link" :value="$activationLink" class="w-full" :readonly="true"/>
                <span class="cursor-pointer px-2 border-l-2 border-l-black" onclick="navigator.clipboard.writeText('{{ $activationLink }}')">
                    <i class="fa-solid fa-copy text-2xl"></i>
                </span>
            </div>
        </x-card-view>
    @endif

        <x-card-view class="mt-6">
            <h1 class="text-xl font-bold">Roles</h1>
            @foreach(\App\Models\Role::all() as $role)
                <label>
                    <x-drop-down.group-item :class="$loop->last ? '' : 'border-b-[2px] border-gray-100 dark:border-gray-900 rounded-none'">
                        <x-slot:title>
                            {{ $role->name }}
                        </x-slot:title>
                        <x-slot:description>
                            {{ $role->description }}
                        </x-slot:description>

                        <input type="checkbox" class="h-8 w-8 bg-gray-200 dark:bg-gray-700 border-none rounded-md" name="roles[]" value="{{ $role->id }}" {{ (old('roles') === null && $user->hasRole($role->name)) ? "checked" : ""}} {{ (old('roles') !== null && in_array($role->id, old('roles'))) ? "checked" : ""}}/>
                    </x-drop-down.group-item>
                </label>
            @endforeach
        </x-card-view>


        {{--        <x-card-view class="mt-5">--}}
        {{--                <div class="flex justify-between items-center pb-3">--}}
        {{--                    <h1 class="font-bold text-2xl"> Share</h1>--}}
        {{--                </div>--}}
        {{--            <div class="flex justify-center w-full h-32 p-5">--}}
        {{--                <div class="w-1/2 border-gray-400 border-2 rounded-lg flex overflow-hidden">--}}
        {{--                    <div class="bg-primary text-white w-1/2 h-full border-r-gray-400 border-r-2 flex-wrap flex justify-center content-center">--}}
        {{--                        <i class="fa-solid fa-link text-3xl"></i>--}}
        {{--                        <h1 class="w-full text-center font-bold text-xl">Share Link</h1>--}}
        {{--                    </div>--}}
        {{--                    <div class="w-1/2 h-full flex-wrap flex justify-center content-center">--}}
        {{--                        <i class="fa-solid fa-envelope text-3xl"></i>--}}
        {{--                        <h1 class="w-full text-center font-bold text-xl">Send E-Mail</h1>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="p-6 w-full flex justify-center content-center items-center">--}}
        {{--                <div class="rounded-md border-2 border-black flex justify-center items-center w-5/6 overflow-hidden">--}}
        {{--                    <input                         value="http://localhost/register?uuid=ae786b45-89a6-4de7-93c5-4e1db106a1f5&signature=44a7157b6808e89cafa476adf427acf419fb4f3389860844a9b8d3e90bb982eb" type="text" disabled class="placeholder:text-gray-400 p-2 border-none w-full">--}}
        {{--                    <span class="cursor-pointer px-2 border-l-2 border-l-black" onclick="navigator.clipboard.writeText('http://localhost/register?uuid=ae786b45-89a6-4de7-93c5-4e1db106a1f5&signature=44a7157b6808e89cafa476adf427acf419fb4f3389860844a9b8d3e90bb982eb')">--}}
        {{--                            <i class="fa-solid fa-copy text-2xl"></i>--}}
        {{--                        </span>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </x-card-view>--}}
</div>
