<!DOCTYPE HTML> <!--検索-->
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search</title>
    </head>
    <body>
        <h1>Post</h1>
        <form action="/search/category/{{ $category->id }}/result" method="POST">
            @csrf
            <div class="body">
                <!--カテゴリー名を表示-->
                <p>カテゴリー</p>
                <p>{{ $category->name }}</p>
                <!--カテゴリーごとに表示を切り替え-->
                @if ($category->id == 1) <!--愛鳥-->
                    <p>誕生日</p> <!--ドロップダウン-->
                    <input type="date" id="start" name="pet_bird_post[birthday]" value="{{ old('pet_bird_post.birthday') }}" min="2018-01-01" max="2024-12-31" />
                    <p>キーワード検索</p>
                    <input type="text" name="pet_bird_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" >
                
                @elseif ($category->id == 2) <!--野鳥-->
                    <p>場所</p> <!--ドロップダウン-->
                    <select name="wild_bird_post[prefecture_id]">
                        <option value="" selected>都道府県を選択してください</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('wild_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p>キーワード検索</p>
                    <input type="text" name="wild_bird_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" >
                
                @elseif ($category->id == 3) <!--イベント-->
                    <p>開催日</p> <!--ドロップダウン-->
                    <input type="date" id="start" name="event_post[start_date]" value="{{ old('event_post.start_date') }}" min="2018-01-01" max="2024-12-31" />
                    <p>場所</p> <!--ドロップダウン-->
                    <select name="event_post[prefecture_id]">
                        <option value="" selected>都道府県を選択してください</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('event_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p>キーワード検索</p>
                    <input type="text" name="event_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" >
                
                @elseif ($category->id == 4) <!--迷子-->
                    <p>日付</p> <!--ドロップダウン-->
                    <input type="date" id="start" name="lost_bird_post[discovery_date]" value="{{ old('lost_bird_post.discovery_date') }}" min="2018-01-01" max="2024-12-31" />
                    <p>ステータス</p> <!--ドロップダウン-->
                    {{--<select name="lost_bird_post[text]">-->
                    <!--    <option value="" selected>ステータスを選択してください</option>-->
                    <!--        @foreach ($lost_bird_posts as $lost_bird_post)-->
                    <!--            <option value="{{ $lost_bird_post->text }}" {{ old('lost_bird_post.text') == $lost_bird_post->id ? 'selected' : '' }}>-->
                    <!--                {{ $lost_bird_post->text }}-->
                    <!--            </option>-->
                    <!--        @endforeach-->
                    <!--</select>--}}
                    <select name="lost_bird_post[text]">
                      <option value="" selected>ステータスを選択してください</option>
                      <option value="迷子">迷子</option>
                      <option value="目撃">目撃</option>
                      <option value="保護">保護</option>
                    </select>
                    <p>場所</p> <!--ドロップダウン-->
                    <select name="lost_bird_post[prefecture_id]">
                        <option value="" selected>都道府県を選択してください</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('lost_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p>キーワード検索</p>
                    <input type="text" name="lost_bird_post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" >

                @elseif ($category->id == 5 || $category->id == 6) <!--雑談、相談-->
                    <p>キーワード検索</p>
                    <input type="text" name="post[keyword]" placeholder="キーワード検索" value="{{request()->keyword}}" >
                @endif
            </div>
            <input type="submit" value="検索">
        </form>
        <div class='footer'>
            <a href="/">戻る</a> <!--戻る-->
        </div>
    </body>
</html>