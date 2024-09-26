<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{--{{ __('Update Password') }}--}}
            {{ __('パスワードを変更') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 explanation mt_8">
            {{--{{ __('Ensure your account is using a long, random password to stay secure.') }}--}}
            {{ __('アカウントのセキュリティを確保するために、長くてランダムなパスワードを使用していることを確認してください。') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mt_16">
            {{--<x-input-label for="update_password_current_password" :value="__('Current Password')" />--}}
            <x-input-label for="update_password_current_password" :value="__('現在のパスワード')" class="title" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" class="detail" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mt_8">
            {{--<x-input-label for="update_password_password" :value="__('New Password')" />--}}
            <x-input-label for="update_password_password" :value="__('新しいパスワード')" class="title" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" class="detail" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mt_8">
            {{--<x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />--}}
            <x-input-label for="update_password_password" :value="__('新しいパスワード確認')" class="title" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" class="detail" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            {{--<x-primary-button>{{ __('Save') }}</x-primary-button>--}}
            <div class="button_box">
                <x-primary-button>{{ __('保存する') }}</x-primary-button>
            </div>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
