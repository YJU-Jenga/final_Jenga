<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('암호를 잊어버렸나요? 괜찮아요. 이메일 주소를 알려주시면 새 주소를 선택할 수 있는 비밀번호 재설정 링크를 이메일로 보내드리겠습니다.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                    required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('이메일 비밀번호 재설정 링크') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>
