        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
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
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    이미 계정이 있습니까?
                </a>

                <button>
                    회원가입
                </button>
            </div>
        </form>
