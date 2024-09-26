<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('/css/auth/style.css') }}">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <p class="title">ログイン</p>

        <!-- Email Address -->
        <div>
            {{--<x-input-label for="email" :value="__('Email')" />--}}
            <input id="email" class="login" type="email" name="email" placeholder="メールアドレス" required  />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            {{--<x-input-label for="password" :value="__('Password')" />--}}
            <x-text-input id="password" class="login mt-16" placeholder="パスワード"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        {{--<div class="block mt-4">-->
        <!--    <label for="remember_me" class="inline-flex items-center">-->
        <!--        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">-->
        <!--        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>-->
        <!--    </label>-->
        <!--</div>--}}

        <div>
            <x-primary-button >
                {{ __('ログイン') }}
            </x-primary-button>
            
            @if (Route::has('password.request'))
                <div class="forget">
                    <a  href="{{ route('password.request') }}" class="visited forget_link">
                        {{ __('パスワードをお忘れの方はこちら') }}
                    </a>
                </div>
            @endif
        </div>
        
        <!-- register -->
        <div class="register"><a href='/register' class="visited register_link">新規登録</a></div>
    </form>
</x-guest-layout>
