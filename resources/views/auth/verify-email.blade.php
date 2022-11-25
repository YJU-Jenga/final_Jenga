<<<<<<< HEAD
<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <!-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> -->
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
=======
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('가입해 주셔서 감사합니다! 시작하기 전에 방금 이메일로 보내드린 링크를 클릭하여 이메일 주소를 확인해 주시겠습니까? 이메일을 받지 못하셨다면 다시 보내드리겠습니다.') }}
>>>>>>> ced5d6b (clean push)
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
<<<<<<< HEAD
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
=======
                {{ __('가입 시 등록하신 메일 주소로 새 링크가 전송되었습니다.') }}
>>>>>>> ced5d6b (clean push)
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
<<<<<<< HEAD
                        {{ __('Resend Verification Email') }}
=======
                        {{ __('확인 메일 재전송') }}
>>>>>>> ced5d6b (clean push)
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
<<<<<<< HEAD
                    {{ __('Log Out') }}
=======
                    {{ __('로그아웃') }}
>>>>>>> ced5d6b (clean push)
                </button>
            </form>
        </div>
    </x-auth-card>
<<<<<<< HEAD
</x-app-layout>
=======
</x-guest-layout>
>>>>>>> ced5d6b (clean push)
