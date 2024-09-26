<x-app-layout><!--検索-->
    <link rel="stylesheet" href="{{ asset('/css/posts_create/style.css') }}">

    <div class="header">
        <div>
            <a href="/">
                <img src="{{ asset('/img/arrow_back.png') }}" class="back">
            </a>
        </div>
        <h1>Post</h1>
    </div>
    <div class="posts">
        <form action="/search/category/{{ $category->id }}/result" method="POST">
            @csrf
            <!--カテゴリー名を表示-->
            <p class="title">カテゴリー</p>
            <p class="category">{{ $category->name }}</p>
            <!--カテゴリーごとに表示を切り替え-->
            @if ($category->id == 1) <!--愛鳥-->
                <div class="title_box">
                    <p class="title">誕生日</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" name="pet_bird_post[birthday]" value="{{ old('pet_bird_post.birthday') }}" min="2018-01-01" max="2024-12-31" class="detail" />
                <div class="title_box">
                    <p class="title">キーワード検索</p>
                    <small class="option">任意</small>
                </div>
                <input type="text" name="pet_bird_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" class="detail" >
            
            @elseif ($category->id == 2) <!--野鳥-->
                <div class="title_box">
                    <p class="title">場所</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                <select name="wild_bird_post[prefecture_id]" class="detail">
                    <option value="" selected>都道府県を選択してください</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('wild_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <div class="title_box">
                    <p class="title">キーワード検索</p>
                    <small class="option">任意</small>
                </div>
                <input type="text" name="wild_bird_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" class="detail" >
            
            @elseif ($category->id == 3) <!--イベント-->
                <div class="title_box">
                    <p class="title">開催日</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" name="event_post[start_date]" value="{{ old('event_post.start_date') }}" min="2018-01-01" max="2024-12-31" class="detail" />
                <div class="title_box">
                    <p class="title">場所</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                <select name="event_post[prefecture_id]" class="detail">
                    <option value="" selected>都道府県を選択してください</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('event_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <div class="title_box">
                    <p class="title">キーワード検索</p>
                    <small class="option">任意</small>
                </div>
                <input type="text" name="event_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" class="detail" >
            
            @elseif ($category->id == 4) <!--迷子-->
                <div class="title_box">
                    <p class="title">日付</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" name="lost_bird_post[discovery_date]" value="{{ old('lost_bird_post.discovery_date') }}" min="2018-01-01" max="2024-12-31" class="detail" />
                <div class="title_box">
                    <p class="title">ステータス</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                {{--<select name="lost_bird_post[text]">-->
                <!--    <option value="" selected>ステータスを選択してください</option>-->
                <!--        @foreach ($lost_bird_posts as $lost_bird_post)-->
                <!--            <option value="{{ $lost_bird_post->text }}" {{ old('lost_bird_post.text') == $lost_bird_post->id ? 'selected' : '' }}>-->
                <!--                {{ $lost_bird_post->text }}-->
                <!--            </option>-->
                <!--        @endforeach-->
                <!--</select>--}}
                <select name="lost_bird_post[text]" class="detail">
                  <option value="" selected>ステータスを選択してください</option>
                  <option value="迷子">迷子</option>
                  <option value="目撃">目撃</option>
                  <option value="保護">保護</option>
                </select>
                <div class="title_box">
                    <p class="title">場所</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                <select name="lost_bird_post[prefecture_id]" class="detail">
                    <option value="" selected>都道府県を選択してください</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('lost_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <div class="title_box">
                    <p class="title">キーワード検索</p>
                    <small class="option">任意</small>
                </div>
                <input type="text" name="lost_bird_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" class="detail" >

            @elseif ($category->id == 5 || $category->id == 6) <!--雑談、相談-->
                <div class="title_box">
                    <p class="title">キーワード検索</p>
                </div>
                <input type="text" name="post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" class="detail" >
            @endif
            <div class="submit_box">
                <input type="submit" class="submit" value="検索する">
            </div>
        </form>
    </div> <!--posts-->
    
    <div class="sp_button">
        <x-post-button />
    </div>
</x-app-layout>