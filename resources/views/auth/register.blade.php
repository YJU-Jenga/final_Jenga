<<<<<<< HEAD
<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <!-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> -->
        </x-slot>

=======
>>>>>>> ced5d6b (clean push)
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
<<<<<<< HEAD
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone')" />

                <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />

                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
=======
                이름 <input id="name" type="text" name="name" required autofocus />
            </div>

            <!-- Email Address -->
            <div>
                이메일 <input id="email" type="email" name="email" required />
            </div>

            <!-- Password -->
            <div>
                비밀번호 <input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div>
                비밀번호 확인 <input id="password_confirmation" type="password" name="password_confirmation" required />
            </div>

            <!-- address -->
            <div>
                주소 <input id="address" type="text" name="address" autofocus />
            </div>

            <!-- tel -->
            <div class="mt-4">
                전화번호 <input id="tel" type="tel" name="tel" autofocus />
>>>>>>> ced5d6b (clean push)
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
<<<<<<< HEAD
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
=======
                    이미 계정이 있습니까?
                </a>

                <button>
                    회원가입
                </button>
            </div>
        </form>
>>>>>>> ced5d6b (clean push)
