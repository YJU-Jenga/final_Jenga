        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                이메일<input id="email" type="email" name="email"required autofocus />
            </div>

            <!-- Password -->
            <div>
                비밀번호<input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div>
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('로그인 유지하기') }}</span>
                </label>
            </div>

            <div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 mr-2"
                        href="{{ route('password.request') }}">
                        {{ __('비밀번호를 잃어버렸나요?') }}
                    </a>
                @endif
                <a href="{{ route('register') }}">
                    {{ __('회원가입') }}
                </a>

                <button>
                    {{ __('로그인') }}
                </button>
            </div>
        </form>
