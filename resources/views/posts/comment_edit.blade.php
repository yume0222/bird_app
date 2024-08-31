<x-app-layout><!--コメント編集-->
        <h1>Post</h1>
        <div class="posts">
            <!--カテゴリー名を表示-->
            <p>カテゴリー</p>
            <p>{{ $post->category->name }}</p>
            <!--カテゴリーごとに表示を切り替え-->
            @if ($category == 1) <!--愛鳥-->
                <p>{{ $post->user->name }}</p>
                <img src="{{ $post->user->image_path }}" alt="画像が読み込めません。">
                <p>{{ $post->created_at }}</p>
                <p>種類</p>
                <p>{{ $post->pet_bird_post->type }}</p>
                <p>性別</p> <!--ラジオボタン-->
                <p>{{ $post->pet_bird_post->gender }}</p>
                <p>誕生日</p> <!--ドロップダウン-->
                <p>{{ $post->pet_bird_post->birthday }}</p>
                <p>性格</p>
                <p>{{ $post->pet_bird_post->personality }}</p>
                <p>特技</p>
                <p>{{ $post->pet_bird_post->special_skil }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p>
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                @endif
                <p>コメント</p>
                <form action="/posts/comment/{{ $commentId }}/update" method="POST"> <!--編集-->
                    @csrf
                    @method('PUT')
                    <textarea name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを保存</button>
                </form>
            
            @elseif ($category == 2) <!--野鳥-->
                <p>{{ $post->user->name }}</p>
                <img src="{{ $post->user->image_path }}" alt="画像が読み込めません。">
                <p>{{ $post->created_at }}</p>
                <p>種類</p>
                <p>{{ $post->wild_bird_post->type }}</p>
                <p>場所</p> <!--ドロップダウン-->
                <p>{{ $prefecture->name }}</p>
                <p>詳細場所</p>
                <p>{{ $post->wild_bird_post->location_detail }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p><p>画像</p>
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                @endif
                <p>コメント</p>
                <form action="/posts/comment/{{ $commentId }}/update" method="POST"> <!--編集-->
                    @csrf
                    @method('PUT')
                    <textarea name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを保存</button>
                </form>
            
            @elseif ($category == 3) <!--イベント-->
                <p>{{ $post->user->name }}</p>
                <img src="{{ $post->user->image_path }}" alt="画像が読み込めません。">
                <p>{{ $post->created_at }}</p>
                <p>イベント名</p>
                <p>{{ $post->event_post->name }}</p>
                <p>開催日</p> <!--ドロップダウン-->
                <p>{{ $post->event_post->start_date }}</p>
                <p>場所</p> <!--ドロップダウン-->
                <p>{{ $prefecture->name }}</p>
                <p>詳細場所</p>
                <p>{{ $post->event_post->location_detail }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p><p>画像</p>
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                @endif
                <p>コメント</p>
                <form action="/posts/comment/{{ $commentId }}/update" method="POST"> <!--編集-->
                    @csrf
                    @method('PUT')
                    <textarea name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを保存</button>
                </form>
            
            @elseif ($category == 4) <!--迷子-->
                <p>{{ $post->user->name }}</p>
                <img src="{{ $post->user->image_path }}" alt="画像が読み込めません。">
                <p>{{ $post->created_at }}</p>
                <p>日付</p> <!--ドロップダウン-->
                <p>{{ $post->lost_bird_post->discovery_date }}</p>
                <p>ステータス</p> <!--ドロップダウン-->
                <p>{{ $post->lost_bird_post->text }}</p>
                <p>場所</p> <!--ドロップダウン-->
                <p>{{ $prefecture->name }}</p>
                <p>詳細場所</p>
                <p>{{ $post->lost_bird_post->location_detail }}</p>
                <p>種類</p>
                <p>{{ $post->lost_bird_post->type }}</p>
                <p>特徴</p>
                <p>{{ $post->lost_bird_post->characteristics }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p>
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                @endif
                <p>コメント</p>
                <form action="/posts/comment/{{ $commentId }}/update" method="POST"> <!--編集-->
                    @csrf
                    @method('PUT')
                    <textarea name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを保存</button>
                </form>
            
            @elseif ($category == 5 || $category == 6) <!--雑談、相談-->
                <p>{{ $post->user->name }}</p>
                <img src="{{ $post->user->image_path }}" alt="画像が読み込めません。">
                <p>{{ $post->created_at }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p>
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                @endif
                <p>コメント</p>
                <form action="/posts/comment/{{ $commentId }}/update" method="POST"> <!--編集-->
                    @csrf
                    @method('PUT')
                    <textarea name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを保存</button>
                </form>
            @endif
        </div>
        <div class='footer'>
            <a href="/">戻る</a> <!--戻る-->
        </div>
</x-app-layout>