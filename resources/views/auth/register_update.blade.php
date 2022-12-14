<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('회원 정보 수정') }}
        </h2>
    </x-slot>
    <x-auth-card>
        <x-slot name="logo">
            <!-- <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a> -->
        </x-slot>

        <form method="POST" action="{{ route('register_update') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" value="{{Auth::user()->name}}" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <!-- <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" value="{{Auth::user()->email}}" required readonly onfocus="this.blur();"/>

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div> -->

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone')" />

                <x-text-input id="phone" class="block w-full mt-1" type="tel" name="phone" value="{{Auth::user()->phone}}" required />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block w-full mt-1"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block w-full mt-1"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('정보 수정') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>