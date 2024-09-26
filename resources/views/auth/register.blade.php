<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('/css/auth/style.css') }}">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <p class="title">新規登録</p>

        <!-- Name -->
        <div>
            {{--<x-input-label for="name" :value="__('Name')" />--}}
            <x-text-input id="name" class="login" type="text" name="name" placeholder="名前" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div>
            {{--<x-input-label for="email" :value="__('Email')" />--}}
            <x-text-input id="email" class="login mt-16" type="email" name="email" placeholder="メールアドレス" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            {{--<x-input-label for="password" :value="__('Password')" />--}}

            <x-text-input id="password" class="login mt-16" placeholder="パスワード"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            {{--<x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

            <x-text-input id="password_confirmation" class="login mt-16" placeholder="パスワード確認"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')"  />
        </div>

        <div class="flex items-center justify-end mt-4">
            {{--<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">-->
            <!--    {{ __('Already registered?') }}-->
            <!--</a>--}}

            <x-primary-button class="ms-4">
                {{ __('新規登録') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
