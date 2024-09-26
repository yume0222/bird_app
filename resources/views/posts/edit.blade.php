<x-app-layout><!--編集画面表示-->
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
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--カテゴリー名を表示-->
            <p class="title">カテゴリー</p>
            <p class="category">{{ $post->category->name }}</p>
            <!--カテゴリーごとに表示を切り替え-->
            @if ($category == 1) <!--愛鳥-->
                <input type="hidden" name="pet_bird_post[id]" value="{{ $post->pet_bird_post->id }}">
                <div class="title_box">
                    <p class="title">種類</p>
                    <small>必須</small>
                </div>
                <input type="text" name="pet_bird_post[type]" value="{{ $post->pet_bird_post->type }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.type') }}</p>
                <div class="title_box">
                    <p class="title">性別</p>
                    <small class="option">任意</small> <!--ラジオボタン-->
                </div>
                <div class="gender">
                    <div class="form-check">
                        <input type="radio" name="pet_bird_post[gender]" id="雄" value="雄" 
                        {{ old('pet_bird_post.gender', $post->pet_bird_post->gender ?? '') == '雄' ? 'checked' : '' }}>
                        <label for="雄">雄</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="pet_bird_post[gender]" id="雌" value="雌" 
                        {{ old('pet_bird_post.gender', $post->pet_bird_post->gender ?? '') == '雌' ? 'checked' : '' }}>
                        <label for="雌">雌</label>
                    </div>
                </div>
                <div class="title_box">
                    <p class="title">誕生日</p>
                    <small class="option">任意</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" value="{{ $post->pet_bird_post->birthday }}" name="pet_bird_post[birthday]" min="2018-01-01" max="2024-12-31" class="detail" />
                <div class="title_box">
                     <p class="title">性格</p>
                     <small>必須</small>
                </div>
                <input type="text" name="pet_bird_post[personality]" value="{{ $post->pet_bird_post->personality }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.personality') }}</p>
                <div class="title_box">
                    <p class="title">特技</p>
                    <small>必須</small>
                </div>
                <input type="text" name="pet_bird_post[special_skil]" value="{{ $post->pet_bird_post->special_skil }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.special_skil') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" value="{{ $post->body }}" class="detail">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input type="file" name="image" value="{{ $post->post_picture_path }}">
                </div>
            
            @elseif ($category == 2) <!--野鳥-->
                <input type="hidden" name="wild_bird_post[id]" value="{{ $post->wild_bird_post->id }}">
                <div class="title_box">
                    <p class="title">種類</p>
                    <small>必須</small>
                </div>
                <input type="text" name="wild_bird_post[type]" value="{{ $post->wild_bird_post->type }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.type') }}</p>
                <div class="title_box">
                    <p class="title">場所</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <select name="wild_bird_post[prefecture]" class="detail">
                    <option value="" disabled>都道府県を選択してください</option>
                    <option value="{{ $post->wild_bird_post->prefecture->id }}">{{ $post->wild_bird_post->prefecture->name }}</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.prefecture') }}</p>
                <div class="title_box">
                    <p class="title">詳細場所</p>
                    <small>必須</small>
                </div>
                <input type="text" name="wild_bird_post[location_detail]" value="{{ $post->wild_bird_post->location_detail }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.location_detail') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" value="{{ $post->body }}" class="detail">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input type="file" name="image" value="{{ $post->post_picture_path }}">
                </div>
            
            @elseif ($category == 3) <!--イベント-->
                <input type="hidden" name="event_post[id]" value="{{ $post->event_post->id }}">
                <div class="title_box">
                    <p class="title">イベント名</p>
                    <small>必須</small>
                </div>
                <input type="text" name="event_post[name]" value="{{ $post->event_post->name }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('event_post.name') }}</p>
                <div class="title_box">
                    <p class="title">開催日</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" value="{{ $post->event_post->start_date }}" name="event_post[start_date]" min="2018-01-01" max="2024-12-31" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('event_post.start_date') }}</p>
                <div class="title_box">
                    <p class="title">場所</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <select name="event_post[prefecture]" class="detail">
                    <option value="" disabled>都道府県を選択してください</option>
                    <option value="{{ $post->event_post->prefecture->id }}">{{ $post->event_post->prefecture->name }}</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('event_post.prefecture') }}</p>
                <div class="title_box">
                    <p class="title">詳細場所</p>
                    <small>必須</small>
                </div>
                <input type="text" name="event_post[location_detail]" value="{{ $post->event_post->location_detail }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('event_post.location_detail') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" value="{{ $post->body }}" class="detail">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input type="file" name="image" value="{{ $post->post_picture_path }}">
                </div>
            
            @elseif ($category == 4) <!--迷子-->
                <input type="hidden" name="lost_bird_post[id]" value="{{ $post->lost_bird_post->id }}">
                <div class="title_box">
                    <p class="title">日付</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <input type="date" id="start" value="{{ $post->lost_bird_post->discovery_date }}" name="lost_bird_post[discovery_date]" min="2018-01-01" max="2024-12-31" class="detail" />
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.discovery_date') }}</p>
                <div class="title_box">
                    <p class="title">ステータス</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                {{--<select name="lost_bird_post[text]">-->
                    <!--<option value="" disabled selected>ステータスを選択してください</option>-->
                <!--    <option value="{{ $post->lost_bird_post->id }}">{{ $post->lost_bird_post->text }}</option>-->
                <!--        @foreach ($lost_bird_posts as $lost_bird_post)-->
                <!--            <option value="{{ $lost_bird_post->id }}" {{ old('lost_bird_post.text') == $lost_bird_post->id ? 'selected' : '' }}>-->
                <!--                {{ $lost_bird_post->text }}-->
                <!--            </option>-->
                <!--        @endforeach-->
                <!--</select>--}}
                <select name="lost_bird_post[text]" class="detail">
                    <option value="" disabled selected>ステータスを選択してください</option>
                    <option value="迷子" {{ old('lost_bird_post.text', $post->lost_bird_post->text) == '迷子' ? 'selected' : '' }}>迷子</option>
                    <option value="保護" {{ old('lost_bird_post.text', $post->lost_bird_post->text) == '保護' ? 'selected' : '' }}>保護</option>
                    <option value="目撃" {{ old('lost_bird_post.text', $post->lost_bird_post->text) == '目撃' ? 'selected' : '' }}>目撃</option>
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.text') }}</p>
                <div class="title_box">
                    <p class="title">場所</p>
                    <small>必須</small> <!--ドロップダウン-->
                </div>
                <select name="lost_bird_post[prefecture]" class="detail">
                    <option value="" disabled>都道府県を選択してください</option>
                    <option value="{{ $post->lost_bird_post->prefecture->id }}">{{ $post->lost_bird_post->prefecture->name }}</option>
                        @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}" {{ old('post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                {{ $prefecture->name }}
                            </option>
                        @endforeach
                </select>
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.prefecture') }}</p>
                <div class="title_box">
                    <p class="title">詳細場所</p>
                    <small>必須</small>
                </div>
                <input type="text" name="lost_bird_post[location_detail]" value="{{ $post->lost_bird_post->location_detail }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.location_detail') }}</p>
                <div class="title_box">
                    <p class="title">種類</p>
                    <small>必須</small>
                </div>
                <input type="text" name="lost_bird_post[type]" value="{{ $post->lost_bird_post->type }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.type') }}</p>
                <div class="title_box">
                    <p class="title">特徴</p>
                    <small>必須</small>
                </div>
                <input type="text" name="lost_bird_post[characteristics]" value="{{ $post->lost_bird_post->characteristics }}" class="detail">
                <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.characteristics') }}</p>
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" value="{{ $post->body }}" class="detail">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input type="file" name="image" value="{{ $post->post_picture_path }}">
                </div>
            
            @elseif ($category == 5 || $category == 6) <!--雑談、相談-->
                <div class="title_box">
                    <p class="title">本文</p>
                    <small>必須</small>
                </div>
                <textarea name="post[body]" value="{{ $post->body }}" class="detail">{{ $post->body }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                <div class="title_box">
                    <p class="title">画像</p>
                    <small class="option">任意</small>
                </div>
                <div class="image">
                    <input type="file" name="image" value="{{ $post->post_picture_path }}">
                </div>
            @endif
            <div class="submit_box">
                <input type="submit" class="submit" value="保存する">
            </div>
        </form>
    </div> <!--posts-->
        
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