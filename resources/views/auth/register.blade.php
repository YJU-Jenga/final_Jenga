<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('이름')" />

                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('이메일')" />

                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('비밀번호')" />

                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('비밀번호 확인')" />

                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <!-- address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('주소')" />

                <x-text-input id="address" class="block w-full mt-1" type="text" name="address" :value="old('address')" autofocus />

                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
            <!-- tel -->
            <div class="mt-4">
                <x-input-label for="tel" :value="__('전화번호')" />

                <x-text-input id="tel" class="block w-full mt-1" type="tel" name="tel" :value="old('tel')" autofocus />

                <x-input-error :messages="$errors->get('tel')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('이미 계정이 있습니까?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>