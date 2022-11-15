<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('가입해 주셔서 감사합니다! 시작하기 전에 방금 이메일로 보내드린 링크를 클릭하여 이메일 주소를 확인해 주시겠습니까? 이메일을 받지 못하셨다면 다시 보내드리겠습니다.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ __('가입 시 등록하신 메일 주소로 새 링크가 전송되었습니다.') }}
            </div>
        @endif

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
                        {{ __('확인 메일 재전송') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="text-sm text-gray-600 underline hover:text-gray-900">
                    {{ __('로그아웃') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-app-layout>
