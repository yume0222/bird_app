<x-app-layout><!--各ユーザのプロフィール表示-->
    <link rel="stylesheet" href="{{ asset('/css/profile_show/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/profile_show_user/style.css') }}">
    
    <div class="header">
        <div>
            <a href="/">
                <img src="{{ asset('/img/arrow_back.png') }}" class="back">
            </a>
        </div>
        <h1>Profile</h1>
    </div>
    <div class="mb">
    <div class="container">
        @if($user->image_path)
            <div>
                <img src="{{ $user->image_path }}" class="pic">
            </div>
        @else
            <div class="img_box">
                <img src="{{ asset('/img/feather.svg') }}" class="icon">
            </div>
        @endif
        <p class="name">{{ $user->name }}</p>
        @if(isset($user->self_introduction)) 
            <p class="self_introduction">{{ $user->self_introduction }}</p>
        @else
            <p class="self_introduction">未入力</p>
        @endif
        <div class="profile_box mt_24">
            <p class="title">性別</p>
            {{--@if($user->gender == 1)-->
            <!--    男性-->
            <!--@endif-->
            <!--@if($user->gender == 2)-->
            <!--    女性-->
            <!--@endif--}}
            @if($user->gender === 1)
                <p>男性</p>
            @elseif($user->gender === 2)
                <p>女性</p>
            @else
                 <p>未入力</p>
            @endif
        </div>
        <div class="profile_box">
            <p class="title">年齢</p>
            @if(isset($user->age)) 
                <p>{{ $user->age }}歳</p>
            @else
                <p>未入力</p>
            @endif
        </div>
        <div class="profile_box">
        <p class="title">都道府県</p>
            @if(isset($user->prefecture_id)) 
                <p>{{ $user->prefecture->name }}</p>
            @else
                <p>未入力</p>
            @endif
        </div>
        <div class="profile_box">
        <p class="title">好きな鳥</p>
            @if(isset($user->favorite_bird)) 
                <p>{{ $user->favorite_bird }}</p>
            @else
                <p>未入力</p>
            @endif
        </div>
        <div class="profile_box">
            <p class="title">愛鳥</p>
            @if(isset($user->my_pet)) 
                <p>{{ $user->my_pet }}</p>
            @else
                <p>未入力</p>
            @endif
        </div>
        <div class="profile_box">
            <p class="title">鳥見場所</p>
            @if(isset($user->bird_watching)) 
                <p>{{ $user->bird_watching }}</p>
            @else
                <p>未入力</p>
            @endif
        </div>
        <p class="title mt_16">お気に入りの鳥画像</p>
        <div class="img_flex">
            @foreach($user->user_bird_pictures as $user_bird_picture)
                <div>
                    <img src="{{ $user_bird_picture->bird_picture->bird_img_path }}" alt="画像が読み込めません。" class="bird_picture">
                </div>
            @endforeach
        </div>
    </div>
    </div>
    
    <div class="sp_button">
        <x-post-button />
    </div>
</x-app-layout>