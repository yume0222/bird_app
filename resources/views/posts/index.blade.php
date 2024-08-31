<x-app-layout><!--投稿一覧-->
    {{--<link rel="stylesheet" href="{{ asset('/css/style.css') }}">--}}
    <style>
        .pagination {
            /*カスタムスタイル */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pagination li {
            /*アクティブじゃない*/
            border-radius: 5px;
            margin: 0 5px;
            width: 30px;
            height: 35px;
            border: 1px solid #9DC3C0;
            color: #9DC3C0;
            display: flex; /* Use flexbox for alignment */
            align-items: center; /* Vertically center */
            justify-content: center; /* Horizontally center */
        }
        .pagination .active {
            /*アクティブページ */
            background-color: #9DC3C0;
            color: #fff;
        }
        /*ポップアップ*/
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }
         h1 {
             background: #9DC3C0;
             height: 64px;
             
             position: sticky;
              top: 0;
              left: 0;
              width: 100%;
         }
         .posts {
             width: calc(100% - 32px);
             border: 1px solid #000;
             margin: 16px auto;
              
         }

         
         
    </style>
        <div class="button_container"><!--sp-->
        <h1>Post</h1>
            @foreach ($posts as $post)
            <div class="posts"><!--各枠-->
                <!--カテゴリー名を表示-->
                <p>カテゴリー</p>
                <p>{{ $post->category->name }}</p>
            <!--カテゴリーごとに表示を切り替え-->
            @if ($post->category_id == 1) <!--愛鳥-->
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
                <a href="/posts/{{ $post->id }}">{{ $post->body }}</a> <!--投稿詳細に遷移--> <!--仮（実際はこの投稿自体をクリックしたら遷移）-->
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                    <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePostPicture()">delete</button> 
                    </form>
                @endif
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                <p>いいね</p> <!--いいね-->
                @if($post->isLikedBy(auth()->user()))
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">いいね解除</button>
                    </form>
                @else
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        <button type="submit">いいね</button>
                    </form>
                @endif
                <p>いいね数: {{ $post->likes->count() }}</p>
            
            @elseif ($post->category_id == 2) <!--野鳥-->
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
                <p>{{ $post->wild_bird_post->prefecture->name }}</p>
                <p>詳細場所</p>
                <p>{{ $post->wild_bird_post->location_detail }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p>
                <a href="/posts/{{ $post->id }}">{{ $post->body }}</a> <!--投稿詳細に遷移--> <!--仮（実際はこの投稿自体をクリックしたら遷移）-->
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                    <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePostPicture()">delete</button> 
                    </form>
                @endif
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                <p>いいね</p> <!--いいね-->
                @if($post->isLikedBy(auth()->user()))
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">いいね解除</button>
                    </form>
                @else
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        <button type="submit">
                            <img src="{{ asset('/img/20230512_185647.jpg') }}" style="width: 20px;">
                        </button>
                    </form>
                @endif
                <p>いいね数: {{ $post->likes->count() }}</p>
            
            @elseif ($post->category_id == 3) <!--イベント-->
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
                <p>{{ $post->event_post->prefecture->name }}</p>
                <p>詳細場所</p>
                <p>{{ $post->event_post->location_detail }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p>
                <a href="/posts/{{ $post->id }}">{{ $post->body }}</a> <!--投稿詳細に遷移--> <!--仮（実際はこの投稿自体をクリックしたら遷移）-->
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                    <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePostPicture()">delete</button> 
                    </form>
                @endif
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                <p>いいね</p> <!--いいね-->
                @if($post->isLikedBy(auth()->user()))
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">いいね解除</button>
                    </form>
                @else
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        <button type="submit">いいね</button>
                    </form>
                @endif
                <p>いいね数: {{ $post->likes->count() }}</p>
            
            @elseif ($post->category_id == 4) <!--迷子-->
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
                <p>{{ $post->lost_bird_post->prefecture->name }}</p>
                <p>詳細場所</p>
                <p>{{ $post->lost_bird_post->location_detail }}</p>
                <p>種類</p>
                <p>{{ $post->lost_bird_post->type }}</p>
                <p>特徴</p>
                <p>{{ $post->lost_bird_post->characteristics }}</p>
                <p>本文</p>
                <p>{{ $post->body }}</p>
                <a href="/posts/{{ $post->id }}">{{ $post->body }}</a> <!--投稿詳細に遷移--> <!--仮（実際はこの投稿自体をクリックしたら遷移）-->
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                    <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePostPicture()">delete</button> 
                    </form>
                @endif
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                <p>いいね</p> <!--いいね-->
                @if($post->isLikedBy(auth()->user()))
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">いいね解除</button>
                    </form>
                @else
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        <button type="submit">いいね</button>
                    </form>
                @endif
                <p>いいね数: {{ $post->likes->count() }}</p>
            
            @elseif ($post->category_id == 5 || $post->category_id == 6) <!--雑談、相談-->
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
                <a href="/posts/{{ $post->id }}">{{ $post->body }}</a> <!--投稿詳細に遷移--> <!--仮（実際はこの投稿自体をクリックしたら遷移）-->
                <p>画像</p>
                @if($post->post_picture_path)
                    <div>
                        <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。">
                    </div>
                    <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePostPicture()">delete</button> 
                    </form>
                @endif
                <span class="comment-count">コメント数: {{ $post->comments->count() }}</span>
                <p>いいね</p> <!--いいね-->
                @if($post->isLikedBy(auth()->user()))
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">いいね解除</button>
                    </form>
                @else
                    <form action="/posts/{{ $post->id }}/like" method="POST">
                        @csrf
                        <button type="submit">いいね</button>
                    </form>
                @endif
                <p>いいね数: {{ $post->likes->count() }}</p>
                
                <div>
                    <img src="{{ asset('/img/20230512_185647.jpg') }}" style="width: 20px;" onclick="togglePopup()">
                </div>
                <div id="popup" class="popup" style="display: none;">
                    <div class="popup-content">
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                        </form>
                        <div class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></div>
                        <button onclick="togglePopup()">Close</button>
                    </div>
                </div>
            @endif
            </div><!--各枠-->
            <!--削除-->
            @endforeach
        <!--<a href='/posts/category'>create</a> <!--投稿作成に遷移-->
        <div class='paginate'>
            {{ $posts->links() }} <!--ペジネーション-->
        </div>
        
        <div class="button"><x-post-button /></div>
        </div><!--sp-->
        
        <script>
            //投稿削除
            function deletePost(id) {
                'use strict'

                if (confirm('削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            //画像削除
            function deletePostPicture(id) {
                'use strict'

                if (confirm('削除しますか？')) {
                    document.getElementById('post_picture_path').submit();
                }
            }
            //ポップアップ
            function togglePopup() {
                var popup = document.getElementById('popup');
                popup.style.display = popup.style.display === 'none' ? 'flex' : 'none';
            }
        </script>
</x-app-layout>