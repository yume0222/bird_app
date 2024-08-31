<x-app-layout><!--編集画面表示-->
        <h1>Post</h1>
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="body">
                <!--カテゴリー名を表示-->
                <p>カテゴリー</p>
                <p>{{ $post->category->name }}</p>
                <!--カテゴリーごとに表示を切り替え-->
                @if ($category == 1) <!--愛鳥-->
                    <input type="hidden" name="pet_bird_post[id]" value="{{ $post->pet_bird_post->id }}">
                    <p>種類</p><small>必須</small>
                    <input type="text" name="pet_bird_post[type]" value="{{ $post->pet_bird_post->type }}">
                    <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.type') }}</p>
                    <p>性別</p><small>任意</small> <!--ラジオボタン-->
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
                    <p>誕生日</p><small>任意</small> <!--ドロップダウン-->
                    {{ $post->pet_bird_post->birthday }}
                    <input type="date" id="start" value="{{ $post->pet_bird_post->birthday }}" name="pet_bird_post[birthday]" min="2018-01-01" max="2024-12-31" />
                    <p>性格</p><small>必須</small>
                    <input type="text" name="pet_bird_post[personality]" value="{{ $post->pet_bird_post->personality }}">
                    <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.personality') }}</p>
                    <p>特技</p><small>必須</small>
                    <input type="text" name="pet_bird_post[special_skil]" value="{{ $post->pet_bird_post->special_skil }}">
                    <p class="title__error" style="color:red">{{ $errors->first('pet_bird_post.special_skil') }}</p>
                    <p>本文</p><small>必須</small>
                    <textarea name="post[body]" value="{{ $post->body }}">{{ $post->body }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p><small>任意</small>
                    <div class="image">
                        <input type="file" name="image" value="{{ $post->post_picture_path }}">
                    </div>
                
                @elseif ($category == 2) <!--野鳥-->
                    <input type="hidden" name="wild_bird_post[id]" value="{{ $post->wild_bird_post->id }}">
                    <p>種類</p><small>必須</small>
                    <input type="text" name="wild_bird_post[type]" value="{{ $post->wild_bird_post->type }}">
                    <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.type') }}</p>
                    <p>場所</p><small>必須</small> <!--ドロップダウン-->
                    <select name="wild_bird_post[prefecture]">
                        <option value="" disabled>都道府県を選択してください</option>
                        <option value="{{ $post->wild_bird_post->prefecture->id }}">{{ $post->wild_bird_post->prefecture->name }}</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.prefecture') }}</p>
                    <p>詳細場所</p><small>必須</small>
                    <input type="text" name="wild_bird_post[location_detail]" value="{{ $post->wild_bird_post->location_detail }}">
                    <p class="title__error" style="color:red">{{ $errors->first('wild_bird_post.location_detail') }}</p>
                    <p>本文</p><small>必須</small>
                    <textarea name="post[body]" value="{{ $post->body }}">{{ $post->body }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p><small>任意</small>
                    <div class="image">
                        <input type="file" name="image" value="{{ $post->post_picture_path }}">
                    </div>
                
                @elseif ($category == 3) <!--イベント-->
                    <input type="hidden" name="event_post[id]" value="{{ $post->event_post->id }}">
                    <p>イベント名</p><small>必須</small>
                    <input type="text" name="event_post[name]" value="{{ $post->event_post->name }}">
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.name') }}</p>
                    <p>開催日</p><small>必須</small> <!--ドロップダウン-->
                    <input type="date" id="start" value="{{ $post->event_post->start_date }}" name="event_post[start_date]" min="2018-01-01" max="2024-12-31" />
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.start_date') }}</p>
                    <p>場所</p><small>必須</small> <!--ドロップダウン-->
                    <select name="event_post[prefecture]">
                        <option value="" disabled>都道府県を選択してください</option>
                        <option value="{{ $post->event_post->prefecture->id }}">{{ $post->event_post->prefecture->name }}</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.prefecture') }}</p>
                    <p>詳細場所</p><small>必須</small>
                    <input type="text" name="event_post[location_detail]" value="{{ $post->event_post->location_detail }}">
                    <p class="title__error" style="color:red">{{ $errors->first('event_post.location_detail') }}</p>
                    <p>本文</p><small>必須</small>
                    <textarea name="post[body]" value="{{ $post->body }}">{{ $post->body }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p><small>任意</small>
                    <div class="image">
                        <input type="file" name="image" value="{{ $post->post_picture_path }}">
                    </div>
                
                @elseif ($category == 4) <!--迷子-->
                    <input type="hidden" name="lost_bird_post[id]" value="{{ $post->lost_bird_post->id }}">
                    <p>日付</p><small>必須</small> <!--ドロップダウン-->
                    <input type="date" id="start" value="{{ $post->lost_bird_post->discovery_date }}" name="lost_bird_post[discovery_date]" min="2018-01-01" max="2024-12-31" />
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.discovery_date') }}</p>
                    <p>ステータス</p><small>必須</small> <!--ドロップダウン-->
                    {{--<select name="lost_bird_post[text]">-->
                        <!--<option value="" disabled selected>ステータスを選択してください</option>-->
                    <!--    <option value="{{ $post->lost_bird_post->id }}">{{ $post->lost_bird_post->text }}</option>-->
                    <!--        @foreach ($lost_bird_posts as $lost_bird_post)-->
                    <!--            <option value="{{ $lost_bird_post->id }}" {{ old('lost_bird_post.text') == $lost_bird_post->id ? 'selected' : '' }}>-->
                    <!--                {{ $lost_bird_post->text }}-->
                    <!--            </option>-->
                    <!--        @endforeach-->
                    <!--</select>--}}
                    <select name="lost_bird_post[text]">
                        <option value="" disabled selected>ステータスを選択してください</option>
                        <option value="迷子" {{ old('lost_bird_post.text', $post->lost_bird_post->text) == '迷子' ? 'selected' : '' }}>迷子</option>
                        <option value="保護" {{ old('lost_bird_post.text', $post->lost_bird_post->text) == '保護' ? 'selected' : '' }}>保護</option>
                        <option value="目撃" {{ old('lost_bird_post.text', $post->lost_bird_post->text) == '目撃' ? 'selected' : '' }}>目撃</option>
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.text') }}</p>
                    <p>場所</p><small>必須</small> <!--ドロップダウン-->
                    <select name="lost_bird_post[prefecture]">
                        <option value="" disabled>都道府県を選択してください</option>
                        <option value="{{ $post->lost_bird_post->prefecture->id }}">{{ $post->lost_bird_post->prefecture->name }}</option>
                            @foreach ($prefectures as $prefecture)
                                <option value="{{ $prefecture->id }}" {{ old('post.prefecture') == $prefecture->id ? 'selected' : '' }}>
                                    {{ $prefecture->name }}
                                </option>
                            @endforeach
                    </select>
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.prefecture') }}</p>
                    <p>詳細場所</p><small>必須</small>
                    <input type="text" name="lost_bird_post[location_detail]" value="{{ $post->lost_bird_post->location_detail }}">
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.location_detail') }}</p>
                    <p>種類</p><small>必須</small>
                    <input type="text" name="lost_bird_post[type]" value="{{ $post->lost_bird_post->type }}">
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.type') }}</p>
                    <p>特徴</p><small>必須</small>
                    <input type="text" name="lost_bird_post[characteristics]" value="{{ $post->lost_bird_post->characteristics }}">
                    <p class="title__error" style="color:red">{{ $errors->first('lost_bird_post.characteristics') }}</p>
                    <p>本文</p><small>必須</small>
                    <textarea name="post[body]" value="{{ $post->body }}">{{ $post->body }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p><small>任意</small>
                    <div class="image">
                        <input type="file" name="image" value="{{ $post->post_picture_path }}">
                    </div>
                
                @elseif ($category == 5 || $category == 6) <!--雑談、相談-->
                    <p>本文</p><small>必須</small>
                    <textarea name="post[body]" value="{{ $post->body }}">{{ $post->body }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                    <p>画像</p><small>任意</small>
                    <div class="image">
                        <input type="file" name="image" value="{{ $post->post_picture_path }}">
                    </div>
                @endif
            </div>
            <input type="submit" value="保存">
        </form>
        <div class='footer'>
            <a href="/">戻る</a> <!--戻る-->
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