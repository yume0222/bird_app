<!DOCTYPE html> <!--投稿詳細-->
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post</title>
    </head>
    <body>
        <h1>Post</h1>
        <div class="posts">
            <!--カテゴリー名を表示-->
            <p>カテゴリー</p>
            <p>{{ $post->category->name }}</p>
            <!--カテゴリーごとに表示を切り替え-->
            @if ($category == 1) <!--愛鳥-->
                <p><a href="/profile/show/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
                @if($post->user->image_path)
                    <div><img src="{{ $post->user->image_path }}"></div>
                @else
                    <p>ピヨ</p> <!--仮-->
                @endif
                <p>{{ $post->created_at }}</p>
                @if ($post->updated_at != $post->created_at)
                    <small>- 編集済み: {{ $post->updated_at }}</small>
                @endif
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
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                @foreach($post->comments as $comment) <!--表示-->
                    <div>
                        <p>{{ $comment->comment }}</p>
                        <small>{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small> <!--コメント投稿時間-->
                        @if ($comment->updated_at != $comment->created_at) <!--コメント編集時間-->
                            <small>- 編集済み: {{ $comment->updated_at->diffForHumans() }}</small>
                        @endif
                    </div>
                    <div class="edit"><a href="/posts/{{ $post->id }}/{{ $comment->id }}/edit">edit</a></div> <!--編集画面表示の遷移-->
                    <form action="/posts/comment/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post"> <!--削除-->
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
                    </form>
                @endforeach
                <p>コメントを投稿</p> <!--投稿-->
                <form action="/posts/{{ $post->id }}/comment" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="コメントしよう。">{{ old('comment') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを投稿</button>
                </form>
            
            @elseif ($category == 2) <!--野鳥-->
                <p><a href="/profile/show/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
                @if($post->user->image_path)
                    <div><img src="{{ $post->user->image_path }}"></div>
                @else
                    <p>ピヨ</p> <!--仮-->
                @endif
                <p>{{ $post->created_at }}</p>
                @if ($post->updated_at != $post->created_at)
                    <small>- 編集済み: {{ $post->updated_at }}</small>
                @endif
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
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                @foreach($post->comments as $comment) <!--表示-->
                    <div>
                        <p>{{ $comment->comment }}</p>
                        <small>{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small> <!--コメント投稿時間-->
                        @if ($comment->updated_at != $comment->created_at) <!--コメント編集時間-->
                            <small>- 編集済み: {{ $comment->updated_at->diffForHumans() }}</small>
                        @endif
                    </div>
                    <div class="edit"><a href="/posts/{{ $post->id }}/{{ $comment->id }}/edit">edit</a></div> <!--編集画面表示の遷移-->
                    <form action="/posts/comment/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post"> <!--削除-->
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
                    </form>
                @endforeach
                <p>コメントを投稿</p> <!--投稿-->
                <form action="/posts/{{ $post->id }}/comment" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="コメントしよう。">{{ old('comment') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを投稿</button>
                </form>
            
            @elseif ($category == 3) <!--イベント-->
                <p><a href="/profile/show/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
                @if($post->user->image_path)
                    <div><img src="{{ $post->user->image_path }}"></div>
                @else
                    <p>ピヨ</p> <!--仮-->
                @endif
                <p>{{ $post->created_at }}</p>
                @if ($post->updated_at != $post->created_at)
                    <small>- 編集済み: {{ $post->updated_at }}</small>
                @endif
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
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                @foreach($post->comments as $comment) <!--表示-->
                    <div>
                        <p>{{ $comment->comment }}</p>
                        <small>{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small> <!--コメント投稿時間-->
                        @if ($comment->updated_at != $comment->created_at) <!--コメント編集時間-->
                            <small>- 編集済み: {{ $comment->updated_at->diffForHumans() }}</small>
                        @endif
                    </div>
                    <div class="edit"><a href="/posts/{{ $post->id }}/{{ $comment->id }}/edit">edit</a></div> <!--編集画面表示の遷移-->
                    <form action="/posts/comment/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post"> <!--削除-->
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
                    </form>
                @endforeach
                <p>コメントを投稿</p> <!--投稿-->
                <form action="/posts/{{ $post->id }}/comment" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="コメントしよう。">{{ old('comment') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを投稿</button>
                </form>
            
            @elseif ($category == 4) <!--迷子-->
                <p><a href="/profile/show/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
                @if($post->user->image_path)
                    <div><img src="{{ $post->user->image_path }}"></div>
                @else
                    <p>ピヨ</p> <!--仮-->
                @endif
                <p>{{ $post->created_at }}</p>
                @if ($post->updated_at != $post->created_at)
                    <small>- 編集済み: {{ $post->updated_at }}</small>
                @endif
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
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                @foreach($post->comments as $comment) <!--表示-->
                    <div>
                        <p>{{ $comment->comment }}</p>
                        <small>{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small> <!--コメント投稿時間-->
                        @if ($comment->updated_at != $comment->created_at) <!--コメント編集時間-->
                            <small>- 編集済み: {{ $comment->updated_at->diffForHumans() }}</small>
                        @endif
                    </div>
                    <div class="edit"><a href="/posts/{{ $post->id }}/{{ $comment->id }}/edit">edit</a></div> <!--編集画面表示の遷移-->
                    <form action="/posts/comment/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post"> <!--削除-->
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
                    </form>
                @endforeach
                <p>コメントを投稿</p> <!--投稿-->
                <form action="/posts/{{ $post->id }}/comment" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="コメントしよう。">{{ old('comment') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを投稿</button>
                </form>
            
            @elseif ($category == 5 || $category == 6) <!--雑談、相談-->
                <p><a href="/profile/show/{{ $post->user->id }}">{{ $post->user->name }}</a></p>
                @if($post->user->image_path)
                    <div><img src="{{ $post->user->image_path }}"></div>
                @else
                    <p>ピヨ</p> <!--仮-->
                @endif
                <p>{{ $post->created_at }}</p>
                @if ($post->updated_at != $post->created_at)
                    <small>- 編集済み: {{ $post->updated_at }}</small>
                @endif
                <p>本文</p>
                <p>{{ $post->body }}</p>
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                @endif
                <p>コメント</p>
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                @foreach($post->comments as $comment) <!--表示-->
                    <div>
                        <p>{{ $comment->comment }}</p>
                        <small>{{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</small> <!--コメント投稿時間-->
                        @if ($comment->updated_at != $comment->created_at) <!--コメント編集時間-->
                            <small>- 編集済み: {{ $comment->updated_at->diffForHumans() }}</small>
                        @endif
                    </div>
                    <div class="edit"><a href="/posts/{{ $post->id }}/{{ $comment->id }}/edit">edit</a></div> <!--編集画面表示の遷移-->
                    <form action="/posts/comment/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post"> <!--削除-->
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
                    </form>
                @endforeach
                <p>コメントを投稿</p> <!--投稿-->
                <form action="/posts/{{ $post->id }}/comment" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="コメントしよう。">{{ old('comment') }}</textarea>
                    <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
                    <button type="submit">コメントを投稿</button>
                </form>
            @endif
        </div>
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></div> <!--編集画面表示の遷移-->
        <div class='footer'>
            <a href="/">戻る</a> <!--戻る-->
        </div>
        
        <script> //コメント削除
            function deleteComment(id) {
                'use strict'

                if (confirm('削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>