<x-app-layout><!--投稿作成-->
    <link rel="stylesheet" href="{{ asset('/css/posts_create/style.css') }}">
    
    <div class="header">
        <div>
            <a href="/">
                <img src="{{ asset('/img/arrow_back.png') }}" class="back">
            </a>
        </div>
        <h1>Post</h1>
    </div>
    <div class="mb">
    <div class="posts">
        <form action="/posts/{{ $category->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--カテゴリー名を表示-->
            <p class="title">カテゴリー</p>
            <p class="category">{{ $category->name }}</p>
            <!--カテゴリーごとに表示を切り替え-->
            @if ($category->id == 1) <!--愛鳥-->
                <div class="title_box">
                    <p class="title">種類</p>
                    <small>必須</small>
                </div>
                <input type="text" name="pet_bird_post[type]" placeholder="セキセイインコ" value="{{ old('pet_bird_post.type') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.type') }}</p>
                <div class="title_box">
                    <p class="title">性別</p> <!--ラジオボタン-->
                    <small class="option">任意</small>
                </div>
                <div class="gender">
                    <div class="form-check">
                        <input type="radio" name="pet_bird_post[gender]" id="雄" value="雄" {{ old('pet_bird_post.gender') == '雄' ? 'checked' : '' }}>
                        <label for="雄">雄</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="pet_bird_post[gender]" id="雌" value="雌" {{ old('pet_bird_post.gender') == '雌' ? 'checked' : '' }}>
                        <label for="雌">雌</label>
                    </div>
                </div>
                <div class="title_box">
                    <p class="title">誕生日</p> <!--ドロップダウン-->
                    <small class="option">任意</small>
                </div>
                <input type="date" id="start" name="pet_bird_post[birthday]" value="{{ old('pet_bird_post.birthday') }}" min="2018-01-01" max="2024-12-31" class="detail" />
                <div class="title_box">
                    <p class="title">性格</p>
                    <small>必須</small>
                </div>
                <input type="text" name="pet_bird_post[personality]" placeholder="おっとり" value="{{ old('pet_bird_post.personality') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.personality') }}</p>
                <div class="title_box">
                    <p class="title">特技</p>
                    <small>必須</small>
                </div>
                <input type="text" name="pet_bird_post[special_skil]" placeholder="寝る" value="{{ old('pet_bird_post.special_skil') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.special_skil') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" placeholder="鳥について話そう。" class="detail">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p
                    ><small class="option">任意</small>
                </div>
                <div class="image">
                    <input name="image" id="image" type="file" onchange="previewImage(event)"/>
                    <img id="image-preview" src="#" alt="プレビュー" style="display: none; width: 200px; height: 200px;"/>
                </div>
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                    <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" style="width: 200px; height: 200px;">
                @endif
            
            @elseif ($category->id == 2) <!--野鳥-->
                <div class="title_box">
                    <p class="title">種類</p>
                    <small>必須</small>
                </div>
                <input type="text" name="wild_bird_post[type]" placeholder="チョウゲンボウ" value="{{ old('wild_bird_post.[type]') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.type') }}</p>
                <div class="title_box">
                    <p class="title">場所</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <select name="wild_bird_post[prefecture]" class="detail" >
                    <option value="" disabled selected>都道府県を選択してください</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('wild_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.prefecture') }}</p>
                <div class="title_box">
                    <p class="title">詳細場所</p>
                    <small>必須</small>
                </div>
                <input type="text" name="wild_bird_post[location_detail]" placeholder="多摩川" value="{{ old('wild_bird_post.[location_detail]') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.location_detail') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" placeholder="鳥について話そう。" class="detail">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input name="image" id="image" type="file" onchange="previewImage(event)"/>
                    <img id="image-preview" src="#" alt="プレビュー" style="display: none; width: 200px; height: 200px;"/>
                </div>
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                    <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" style="width: 200px; height: 200px;">
                @endif
            
            @elseif ($category->id == 3) <!--イベント-->
                <div class="title_box">
                    <p class="title">イベント名</p>
                    <small>必須</small>
                </div>
                <input type="text" name="event_post[name]" placeholder="新宿ことり祭り" value="{{ old('event_post.[name]') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('event_post.name') }}</p>
                <div class="title_box">
                    <p class="title">開催日</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" name="event_post[start_date]" value="{{ old('event_post.start_date') }}" min="2018-01-01" max="2024-12-31" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('event_post.start_date') }}</p>
                <div class="title_box">
                    <p class="title">場所</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <select name="event_post[prefecture]" class="detail">
                    <option value="" disabled selected>都道府県を選択してください</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('event_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('event_post.prefecture') }}</p>
                <div class="title_box">
                    <p class="title">詳細場所</p>
                    <small>必須</small>
                </div>
                <input type="text" name="event_post[location_detail]" placeholder="新宿駅" value="{{ old('event_post.[location_detail]') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('event_post.location_detail') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" placeholder="鳥について話そう。" class="detail">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input name="image" id="image" type="file" onchange="previewImage(event)"/>
                    <img id="image-preview" src="#" alt="プレビュー" style="display: none; width: 200px; height: 200px;"/>
                </div>
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                    <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" style="width: 200px; height: 200px;">
                @endif
            
            @elseif ($category->id == 4) <!--迷子-->
                <div class="title_box">
                    <p class="title">日付</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" name="lost_bird_post[discovery_date]" value="{{ old('lost_bird_post.discovery_date') }}" min="2018-01-01" max="2024-12-31" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.discovery_date') }}</p>
                <div class="title_box">
                    <p>ステータス</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                {{--<select name="lost_bird_post[text]">-->
                <!--    <option value="" disabled selected>ステータスを選択してください</option>-->
                <!--        @foreach ($lost_bird_posts as $lost_bird_post)-->
                <!--            <option value="{{ $lost_bird_post->text }}" {{ old('lost_bird_post.text') == $lost_bird_post->id ? 'selected' : '' }}>-->
                <!--                {{ $lost_bird_post->text }}-->
                <!--            </option>-->
                <!--        @endforeach-->
                <!--</select>--}}
                <select name="lost_bird_post[text]" class="detail">
                  <option value="" disabled selected>ステータスを選択してください</option>
                  <option value="迷子">迷子</option>
                  <option value="保護">保護</option>
                  <option value="目撃">目撃</option>
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.text') }}</p>
                <div class="title_box">
                    <p class="title">場所</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <select name="lost_bird_post[prefecture]" class="detail">
                    <option value="" disabled selected>都道府県を選択してください</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('lost_bird_post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.prefecture') }}</p>
                <div class="title_box">
                    <p class="title">詳細場所</p>
                    <small>必須</small>
                </div>
                <input type="text" name="lost_bird_post[location_detail]" placeholder="新宿付近" value="{{ old('lost_bird_post.[location_detail]') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.location_detail') }}</p>
                <div class="title_box">
                    <p class="title">種類</p>
                    <small>必須</small>
                </div>
                <input type="text" name="lost_bird_post[type]" placeholder="セキセイインコ" value="{{ old('lost_bird_post.[type]') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.type') }}</p>
                <div class="title_box">
                    <p class="title">特徴</p>
                    <small>必須</small>
                </div>
                <input type="text" name="lost_bird_post[characteristics]" placeholder="白い" value="{{ old('lost_bird_post.[characteristics]') }}" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.characteristics') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" placeholder="鳥について話そう。" class="detail">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input name="image" id="image" type="file" onchange="previewImage(event)"/>
                    <img id="image-preview" src="#" alt="プレビュー" style="display: none; width: 200px; height: 200px;"/>
                </div>
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                    <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" style="width: 200px; height: 200px;">
                @endif
            
            @elseif ($category->id == 5 || $category->id == 6) <!--雑談、相談-->
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" placeholder="鳥について話そう。" class="detail">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input name="image" id="image" type="file" onchange="previewImage(event)"/>
                    <img id="image-preview" src="#" alt="プレビュー" style="display: none; width: 200px; height: 200px;"/>
                </div>
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                    <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" style="width: 200px; height: 200px;">
                @endif
            @endif
        
            <div class="submit_box">
                <input type="submit" class="submit" value="投稿する"/>
            </div>
        </form>
    </div> <!--posts-->
    </div>
    
    <div class="sp_button">
        <x-post-button />
    </div>

    <script>
        function previewImage(event) { 
            console.log("image");
            var reader = new FileReader();
            reader.onload = function(){ 
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        } 
    </script>
</x-app-layout>