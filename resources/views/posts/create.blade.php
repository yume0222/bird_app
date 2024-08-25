<!DOCTYPE HTML> <!--投稿作成-->
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post</title>
    </head>
    <body>
        <h1>Post</h1>
        <form action="/posts/{{ $category->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="body">
                <!--カテゴリー名を表示-->
                <p>カテゴリー</p>
                <p>{{ $category->name }}</p>
                <!--カテゴリーごとに表示を切り替え-->
                @if ($category->id == 1) <!--愛鳥-->
                    <p>種類</p>
                    <input type="text" name="pet_bird_post[type]" placeholder="セキセイインコ" value="{{ old('pet_bird_post.type') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.type') }}</p>
                    <p>性別</p> <!--ラジオボタン-->
                    <div class="form-check">
                        <input type="radio" name="pet_bird_post[gender]" id="雄" value="雄" {{ old('pet_bird_post.gender') == '雄' ? 'checked' : '' }}>
                        <label for="雄">雄</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="pet_bird_post[gender]" id="雌" value="雌" {{ old('pet_bird_post.gender') == '雌' ? 'checked' : '' }}>
                        <label for="雌">雌</label>
                    </div>
                    <p>誕生日</p> <!--ドロップダウン-->
                    <input type="date" id="start" name="pet_bird_post[birthday]" value="{{ old('pet_bird_post.birthday') }}" min="2018-01-01" max="2024-12-31" />
                    <p>性格</p>
                    <input type="text" name="pet_bird_post[personality]" placeholder="おっとり" value="{{ old('pet_bird_post.personality') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.personality') }}</p>
                    <p>特技</p>
                    <input type="text" name="pet_bird_post[special_skil]" placeholder="寝る" value="{{ old('pet_bird_post.special_skil') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.special_skil') }}</p>
                    <p>本文</p>
                    <textarea name="post[body]" placeholder="鳥について話そう。">{{ old('post.body') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p>
                    <div class="image">
                        <input type="file" name="image">
                    </div>
                
                @elseif ($category->id == 2) <!--野鳥-->
                    <p>種類</p>
                    <input type="text" name="wild_bird_post[type]" placeholder="チョウゲンボウ" value="{{ old('wild_bird_post.[type]') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.type') }}</p>
                    <p>場所</p> <!--ドロップダウン-->
                    <select name="wild_bird_post[prefecture]">
                        <option value="" disabled selected>都道府県を選択してください</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('wild_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.prefecture') }}</p>
                    <p>詳細場所</p>
                    <input type="text" name="wild_bird_post[location_detail]" placeholder="多摩川" value="{{ old('wild_bird_post.[location_detail]') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.location_detail') }}</p>
                    <p>本文</p>
                    <textarea name="post[body]" placeholder="鳥について話そう。">{{ old('post.body') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p>
                    <div class="image">
                        <input type="file" name="image">
                    </div>
                
                @elseif ($category->id == 3) <!--イベント-->
                    <p>イベント名</p>
                    <input type="text" name="event_post[name]" placeholder="新宿ことり祭り" value="{{ old('event_post.[name]') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.name') }}</p>
                    <p>開催日</p> <!--ドロップダウン-->
                    <input type="date" id="start" name="event_post[start_date]" value="{{ old('event_post.start_date') }}" min="2018-01-01" max="2024-12-31" />
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.start_date') }}</p>
                    <p>場所</p> <!--ドロップダウン-->
                    <select name="event_post[prefecture]">
                        <option value="" disabled selected>都道府県を選択してください</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('event_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.prefecture') }}</p>
                    <p>詳細場所</p>
                    <input type="text" name="event_post[location_detail]" placeholder="新宿駅" value="{{ old('event_post.[location_detail]') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.location_detail') }}</p>
                    <p>本文</p>
                    <textarea name="post[body]" placeholder="鳥について話そう。">{{ old('post.body') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p>
                    <div class="image">
                        <input type="file" name="image">
                    </div>
                
                @elseif ($category->id == 4) <!--迷子-->
                    <p>日付</p> <!--ドロップダウン-->
                    <input type="date" id="start" name="lost_bird_post[discovery_date]" value="{{ old('lost_bird_post.discovery_date') }}" min="2018-01-01" max="2024-12-31" />
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.discovery_date') }}</p>
                    <p>ステータス</p> <!--ドロップダウン-->
                    {{--<select name="lost_bird_post[text]">-->
                    <!--    <option value="" disabled selected>ステータスを選択してください</option>-->
                    <!--        @foreach ($lost_bird_posts as $lost_bird_post)-->
                    <!--            <option value="{{ $lost_bird_post->text }}" {{ old('lost_bird_post.text') == $lost_bird_post->id ? 'selected' : '' }}>-->
                    <!--                {{ $lost_bird_post->text }}-->
                    <!--            </option>-->
                    <!--        @endforeach-->
                    <!--</select>--}}
                    <select name="lost_bird_post[text]">
                      <option value="" disabled selected>ステータスを選択してください</option>
                      <option value="迷子">迷子</option>
                      <option value="保護">保護</option>
                      <option value="目撃">目撃</option>
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.text') }}</p>
                    <p>場所</p> <!--ドロップダウン-->
                    <select name="lost_bird_post[prefecture]">
                        <option value="" disabled selected>都道府県を選択してください</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('lost_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.prefecture') }}</p>
                    <p>詳細場所</p>
                    <input type="text" name="lost_bird_post[location_detail]" placeholder="新宿付近" value="{{ old('lost_bird_post.[location_detail]') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.location_detail') }}</p>
                    <p>種類</p>
                    <input type="text" name="lost_bird_post[type]" placeholder="セキセイインコ" value="{{ old('lost_bird_post.[type]') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.type') }}</p>
                    <p>特徴</p>
                    <input type="text" name="lost_bird_post[characteristics]" placeholder="白い" value="{{ old('lost_bird_post.[characteristics]') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.characteristics') }}</p>
                    <p>本文</p>
                    <textarea name="post[body]" placeholder="鳥について話そう。">{{ old('post.body') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p>
                    <div class="image">
                        <input type="file" name="image">
                    </div>
                
                @elseif ($category->id == 5 || $category->id == 6) <!--雑談、相談-->
                    <p>本文</p>
                    <textarea name="post[body]" placeholder="鳥について話そう。">{{ old('post.body') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p>
                    <div class="image">
                        <input type="file" name="image">
                    </div>
                @endif
            </div>
            <input type="submit" value="投稿する"/>
        </form>
        <div class='footer'>
            <a href="/">戻る</a> <!--戻る-->
        </div>
    </body>
</html>