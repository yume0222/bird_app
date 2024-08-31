<x-app-layout><!--プロフィール表示-->
<style>
    img {
        width: 20px;
height: 20px;    }
</style>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                    this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        <p>プロフィール画像</p>
        @if($user->image_path)
            <div>
                <img src="{{ $user->image_path }}">
            </div>
            <form action="/profile_picture/{{ $user->id }}" id="image_path" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteProfilePicture()">delete</button>
            </form>
        @else
            <p>ピヨ</p> <!--仮-->
        @endif
        <p>名前</p>
        {{ $user->name }}
        <p>自己紹介</p>
        @if(isset($user->self_introduction)) 
            {{ $user->self_introduction }}
        @else
            <p>未入力</p>
        @endif
        <p>性別</p>
        {{--@if($user->gender == 1)-->
        <!--    男性-->
        <!--@endif-->
        <!--@if($user->gender == 2)-->
        <!--    女性-->
        <!--@endif--}}
        @if($user->gender === 1)
            男性
        @elseif($user->gender === 2)
            女性
        @else
             <p>未入力</p>
        @endif
        <p>年齢</p>
        @if(isset($user->age)) 
            {{ $user->age }}
        @else
            <p>未入力</p>
        @endif
        <p>都道府県</p>
        @if(isset($user->prefecture_id)) 
            {{ $user->prefecture->name }}
        @else
            <p>未入力</p>
        @endif
        <p>好きな鳥</p>
        @if(isset($user->favorite_bird)) 
            {{ $user->favorite_bird }}
        @else
            <p>未入力</p>
        @endif
        <p>愛鳥</p>
        @if(isset($user->my_pet)) 
            {{ $user->my_pet }}
        @else
            <p>未入力</p>
        @endif
        <p>鳥見場所</p>
        @if(isset($user->bird_watching)) 
            {{ $user->bird_watching }}
        @else
            <p>未入力</p>
        @endif
        <p>Email</p>
        {{ $user->email }}
        <p>お気に入りの鳥画像</p>
        @foreach($user->user_bird_pictures as $user_bird_picture)
            <div>
                <img src="{{ $user_bird_picture->bird_picture->bird_img_path }}" alt="画像が読み込めません。">
            </div>
            <form action="/bird_pictures/{{ $user_bird_picture->bird_picture->id }}" id="form_{{ $user_bird_picture->bird_picture->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePicture({{ $user_bird_picture->bird_picture->id }})">delete</button> 
            </form>
        @endforeach
        <a href='/profile/edit'>edit</a> <!--プロフィール編集に遷移-->
        
        <script> //削除
            //お気に入りの鳥写真
            function deletePicture(id) {
                'use strict'

                if (confirm('削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            //プロフィール写真
            function deleteProfilePicture() {
                'use strict'

                if (confirm('削除しますか？')) {
                    document.getElementById('image_path').submit();
                }
            }
        </script>
</x-app-layout>