<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        
        <div>
            <x-input-label for="image_path" :value="__('プロフィール画像')" />
            {{--<div>-->
            <!--    @php($key = 'form.file')-->
            <!--    @if ($form['file'])-->
            <!--        <img class="h-[300px] object-fit mx-auto" src="{{ $form['file']->temporaryUrl() }}" alt="">  -->
            <!--    @else-->
            <!--        <input name="image_path" type="file" wire:model.defer="{{ $key }}" :value="old('image_path', $user->image_path)" autofocus autocomplete="image_path" />-->
            <!--    @endif--}}
            <!--</div>-->
            <div class="image">
                <input name="image_path" id="image" type="file" :value="old('image_path', $user->image_path)" autofocus autocomplete="image_path" accept="image/*" onchange="previewImage(event)"/>
                <img id="image-preview" src="#" alt="プレビュー" style="display: none; width: 200px; height: 200px;"/>
            </div>
            @if (session('success'))
                <p>{{ session('success') }}</p
                <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" style="width: 200px; height: 200px;">
            @endif
            <x-input-error class="mt-2" :messages="$errors->get('image_path')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="self_introduction" :value="__('自己紹介')" />
            <x-text-input id="self_introduction" name="self_introduction" type="text" class="mt-1 block w-full" :value="old('self_introduction', $user->self_introduction)" required autofocus autocomplete="self_introduction" />
            <x-input-error class="mt-2" :messages="$errors->get('self_introduction')" />
        </div>
        <x-input-label for="gender" :value="__('性別')" />
            <div class="form-check">
                <input type="radio" name="gender" id="male" value=1 {{ old('gender', $user->gender) == 1 ? 'checked' : '' }}>
                <label for="male">男性</label>
            </div>
            <div class="form-check">
                <input type="radio" name="gender" id="female" value=2 {{ old('gender', $user->gender) == 2 ? 'checked' : '' }}>
                <label for="female">女性</label>
            </div>
        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        <div>
            <x-input-label for="gender" :value="__('年齢')" />
            <select name="age">
                <option value="" disabled selected>年齢を選択してください</option>
                    @foreach(range(1, 100) as $age)
                        <option value="{{ $age }}" {{ old('age', $user->age) == $age ? 'selected' : '' }} autofocus autocomplete="age" />
                            {{ $age }}
                        </option>
                    @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('都道府県')" />
            <select name="prefecture_id">
                {{--<option value="" disabled selected>都道府県を選択してください</option>-->
                <!--    @foreach ($prefectures as $prefecture)-->
                <!--        <option value="{{ $prefecture->id }}" {{ old('prefecture' , $user->name) == $prefecture->id ? 'selected' : '' }} autofocus autocomplete="prefecture" />-->
                <!--            {{ $prefecture->name }}-->
                <!--        </option>-->
                <!--    @endforeach--}}
                <option value="" disabled {{ empty(old('prefecture_id', $user->prefecture_id)) ? 'selected' : '' }}>都道府県を選択してください</option>
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" {{ (old('prefecture', $user->prefecture_id) == $prefecture->id) ? 'selected' : '' }}>
                         {{ $prefecture->name }}
                        </option>
                    @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('prefecture_id')" />
        </div>
        <div>
            <x-input-label for="favorite_bird" :value="__('好きな鳥')" />
            <x-text-input id="favorite_bird" name="favorite_bird" type="text" class="mt-1 block w-full" :value="old('favorite_bird', $user->favorite_bird)" autofocus autocomplete="favorite_bird" />
            <x-input-error class="mt-2" :messages="$errors->get('favorite_bird')" />
        </div>
        <div>
            <x-input-label for="my_pet" :value="__('愛鳥')" />
            <x-text-input id="my_pet" name="my_pet" type="text" class="mt-1 block w-full" :value="old('my_pet', $user->my_pet)" autofocus autocomplete="my_pet" />
            <x-input-error class="mt-2" :messages="$errors->get('my_pet')" />
        </div>
        <div>
            <x-input-label for="bird_watchingn" :value="__('鳥見場所')" />
            <x-text-input id="bird_watching" name="bird_watching" type="text" class="mt-1 block w-full" :value="old('bird_watching', $user->bird_watching)" autofocus autocomplete="bird_watching" />
            <x-input-error class="mt-2" :messages="$errors->get('bird_watching')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div>
            <p>お気に入りの鳥写真</p>
            <p><a href="/profile/picture">お気に入りの鳥写真のリンク</a></p>
            @foreach($user->user_bird_pictures as $user_bird_picture)
                <div>
                    <img src="{{ $user_bird_picture->bird_picture->bird_img_path }}" alt="画像が読み込めません。">
                </div>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
    <script>
        function previewImage(event) { 
            var reader = new FileReader();
            reader.onload = function(){ 
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        } 
    </script>
</section>
