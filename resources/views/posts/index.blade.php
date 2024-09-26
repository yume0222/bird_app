<x-app-layout><!--投稿一覧-->
    <link rel="stylesheet" href="{{ asset('/css/posts_index/style.css') }}">
    
    <h1>Post</h1>
    <div class="mb">
    @foreach ($posts as $post)
        <div class="posts"><!--各枠-->
        <!--カテゴリーごとに表示を切り替え-->
            @if ($post->category_id == 1) <!--愛鳥-->
                <div class="container">
                    @if($post->user->image_path)
                        <div>
                            <img src="{{ $post->user->image_path }}" class="pic">
                        </div>
                    @else
                        <div class="img_box">
                            <img src="{{ asset('/img/feather.svg') }}" class="icon">
                        </div>
                    @endif
                    <div> <!--piyo-->
                        <div class="data">
                            <p class="name">
                                <a href="/profile/show/{{ $post->user->id }}" class="visited">
                                    {{ $post->user->name }}
                                </a>
                            </p>
                            @if ($post->updated_at != $post->created_at)
                                <p class="date">編集済み: {{ $post->updated_at }}</p>
                            @else
                                <p class="date">{{ $post->created_at }}</p>
                            @endif
                        </div> <!--data-->
                        <p class="detail">{{ $post->category->name }}・{{ $post->pet_bird_post->type }}・{{ $post->pet_bird_post->gender }}・{{ $post->pet_bird_post->birthday }}・{{ $post->pet_bird_post->personality }}・{{ $post->pet_bird_post->special_skil }}</p>
                        <p class="body">{{ $post->body }}</p>
                    </div> <!--piyo-->
                    <div class="option_box">
                        <div>
                             <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})">
                                    <img src="{{ asset('/img/bin.svg') }}" class="option">
                                </button> 
                            </form>
                        </div>
                        <div>
                            <a href="/posts/{{ $post->id }}/edit">
                                <img src="{{ asset('/img/edit.svg') }}" class="option">
                            </a>
                        </div>
                    </div> <!--option_box-->
                </div> <!--container-->
                @if($post->post_picture_path)
                    <div class="post_pic_box">
                        <div>
                            <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。" class="post_pic">
                        </div>
                        <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePostPicture()">
                                <div class="circle-container">
                                    <div class="circle-box">
                                        <img src="{{ asset('/img/close.svg') }}" class="delete">
                                    </div>
                                </div>
                            </button> 
                        </form>
                    </div>
                @endif
                <div class="more_box ml_66">
                    <div class="action_box">
                        <!--いいね-->
                        <div class="like_box">
                            @if($post->isLikedBy(auth()->user()))
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <img src="{{ asset('/img/liked.png') }}" class="action">
                                    </button>
                                </form>
                            @else
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <img src="{{ asset('/img/like.png') }}" class="action">
                                    </button>
                                </form>
                            @endif
                            <p class="count">{{ $post->likes->count() }}</p>
                        </div>
                        <!--コメント-->
                        <div class="comment_box">
                            <div>
                                <img src="{{ asset('/img/chat.png') }}" class="action">
                            </div>
                            <p class="count">{{ $post->comments->count() }}</p>
                        </div>
                    </div> <!--action_box-->
                    <div class="view_box"> <!--view_box-->
                        <a href="/posts/{{ $post->id }}" class="visited">
                            <p class="view">投稿を見る</p>
                            <div>
                                <img src="{{ asset('/img/chevron-right.svg') }}" class="right">
                            </div>
                        </a>
                    </div> <!--view_box-->
                </div>
            
            @elseif ($post->category_id == 2) <!--野鳥-->
                <div class="container">
                    @if($post->user->image_path)
                        <div>
                            <img src="{{ $post->user->image_path }}" class="pic">
                        </div>
                    @else
                        <div class="img_box">
                            <img src="{{ asset('/img/feather.svg') }}" class="icon">
                        </div>
                    @endif
                    <div> <!--piyo-->
                        <div class="data">
                            <p class="name">
                                <a href="/profile/show/{{ $post->user->id }}" class="visited">
                                    {{ $post->user->name }}
                                </a>
                            </p>
                            @if ($post->updated_at != $post->created_at)
                                <p class="date">編集済み: {{ $post->updated_at }}</p>
                            @else
                                <p class="date">{{ $post->created_at }}</p>
                            @endif
                        </div> <!--data-->
                        <p class="detail">{{ $post->category->name }}・{{ $post->wild_bird_post->type }}・{{ $post->wild_bird_post->prefecture->name }}・{{ $post->wild_bird_post->location_detail }}</p>
                        <p class="body">{{ $post->body }}</p>
                    </div> <!--piyo-->
                    <div class="option_box">
                        <div>
                             <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})">
                                    <img src="{{ asset('/img/bin.svg') }}" class="option">
                                </button> 
                            </form>
                        </div>
                        <div>
                            <a href="/posts/{{ $post->id }}/edit">
                                <img src="{{ asset('/img/edit.svg') }}" class="option">
                            </a>
                        </div>
                    </div> <!--option_box-->
                </div> <!--container-->
                @if($post->post_picture_path)
                    <div class="post_pic_box">
                        <div>
                            <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。" class="post_pic">
                        </div>
                        <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePostPicture()">
                                <div class="circle-container">
                                    <div class="circle-box">
                                        <img src="{{ asset('/img/close.svg') }}" class="delete">
                                    </div>
                                </div>
                            </button> 
                        </form>
                    </div>
                @endif
                <div class="more_box ml_66">
                    <div class="action_box">
                        <!--いいね-->
                        <div class="like_box">
                            @if($post->isLikedBy(auth()->user()))
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <img src="{{ asset('/img/liked.png') }}" class="action">
                                    </button>
                                </form>
                            @else
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <img src="{{ asset('/img/like.png') }}" class="action">
                                    </button>
                                </form>
                            @endif
                            <p class="count">{{ $post->likes->count() }}</p>
                        </div>
                        <!--コメント-->
                        <div class="comment_box">
                            <div>
                                <img src="{{ asset('/img/chat.png') }}" class="action">
                            </div>
                            <p class="count">{{ $post->comments->count() }}</p>
                        </div>
                    </div> <!--action_box-->
                    <div class="view_box"> <!--view_box-->
                        <a href="/posts/{{ $post->id }}" class="visited">
                            <p class="view">投稿を見る</p>
                            <div>
                                <img src="{{ asset('/img/chevron-right.svg') }}" class="right">
                            </div>
                        </a>
                    </div> <!--view_box-->
                </div>
            
            @elseif ($post->category_id == 3) <!--イベント-->
                <div class="container">
                    @if($post->user->image_path)
                        <div>
                            <img src="{{ $post->user->image_path }}" class="pic">
                        </div>
                    @else
                        <div class="img_box">
                            <img src="{{ asset('/img/feather.svg') }}" class="icon">
                        </div>
                    @endif
                    <div> <!--piyo-->
                        <div class="data">
                            <p class="name">
                                <a href="/profile/show/{{ $post->user->id }}" class="visited">
                                    {{ $post->user->name }}
                                </a>
                            </p>
                            @if ($post->updated_at != $post->created_at)
                                <p class="date">編集済み: {{ $post->updated_at }}</p>
                            @else
                                <p class="date">{{ $post->created_at }}</p>
                            @endif
                        </div> <!--data-->
                        <p class="detail">{{ $post->category->name }}・{{ $post->event_post->name }}・{{ $post->event_post->start_date }}・{{ $post->event_post->prefecture->name }}・{{ $post->event_post->location_detail }}</p>
                        <p class="body">{{ $post->body }}</p>
                    </div> <!--piyo-->
                    <div class="option_box">
                        <div>
                             <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})">
                                    <img src="{{ asset('/img/bin.svg') }}" class="option">
                                </button> 
                            </form>
                        </div>
                        <div>
                            <a href="/posts/{{ $post->id }}/edit">
                                <img src="{{ asset('/img/edit.svg') }}" class="option">
                            </a>
                        </div>
                    </div> <!--option_box-->
                </div> <!--container-->
                @if($post->post_picture_path)
                    <div class="post_pic_box">
                        <div>
                            <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。" class="post_pic">
                        </div>
                        <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePostPicture()">
                                <div class="circle-container">
                                    <div class="circle-box">
                                        <img src="{{ asset('/img/close.svg') }}" class="delete">
                                    </div>
                                </div>
                            </button> 
                        </form>
                    </div>
                @endif
                <div class="more_box ml_66">
                    <div class="action_box">
                        <!--いいね-->
                        <div class="like_box">
                            @if($post->isLikedBy(auth()->user()))
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <img src="{{ asset('/img/liked.png') }}" class="action">
                                    </button>
                                </form>
                            @else
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <img src="{{ asset('/img/like.png') }}" class="action">
                                    </button>
                                </form>
                            @endif
                            <p class="count">{{ $post->likes->count() }}</p>
                        </div>
                        <!--コメント-->
                        <div class="comment_box">
                            <div>
                                <img src="{{ asset('/img/chat.png') }}" class="action">
                            </div>
                            <p class="count">{{ $post->comments->count() }}</p>
                        </div>
                    </div> <!--action_box-->
                    <div class="view_box"> <!--view_box-->
                        <a href="/posts/{{ $post->id }}" class="visited">
                            <p class="view">投稿を見る</p>
                            <div>
                                <img src="{{ asset('/img/chevron-right.svg') }}" class="right">
                            </div>
                        </a>
                    </div> <!--view_box-->
                </div>
            
            @elseif ($post->category_id == 4) <!--迷子-->
                <div class="container">
                    @if($post->user->image_path)
                        <div>
                            <img src="{{ $post->user->image_path }}" class="pic">
                        </div>
                    @else
                        <div class="img_box">
                            <img src="{{ asset('/img/feather.svg') }}" class="icon">
                        </div>
                    @endif
                    <div> <!--piyo-->
                        <div class="data">
                            <p class="name">
                                <a href="/profile/show/{{ $post->user->id }}" class="visited">
                                    {{ $post->user->name }}
                                </a>
                            </p>
                            @if ($post->updated_at != $post->created_at)
                                <p class="date">編集済み: {{ $post->updated_at }}</p>
                            @else
                                <p class="date">{{ $post->created_at }}</p>
                            @endif
                        </div> <!--data-->
                        <p class="detail">{{ $post->category->name }}・{{ $post->lost_bird_post->discovery_date }}・{{ $post->lost_bird_post->text }}・{{ $post->lost_bird_post->prefecture->name }}・{{ $post->lost_bird_post->location_detail }}・{{ $post->lost_bird_post->type }}・{{ $post->lost_bird_post->characteristics }}</p>
                        <p class="body">{{ $post->body }}</p>
                    </div> <!--piyo-->
                    <div class="option_box">
                        <div>
                             <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})">
                                    <img src="{{ asset('/img/bin.svg') }}" class="option">
                                </button> 
                            </form>
                        </div>
                        <div>
                            <a href="/posts/{{ $post->id }}/edit">
                                <img src="{{ asset('/img/edit.svg') }}" class="option">
                            </a>
                        </div>
                    </div> <!--option_box-->
                </div> <!--container-->
                @if($post->post_picture_path)
                    <div class="post_pic_box">
                        <div>
                            <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。" class="post_pic">
                        </div>
                        <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePostPicture()">
                                <div class="circle-container">
                                    <div class="circle-box">
                                        <img src="{{ asset('/img/close.svg') }}" class="delete">
                                    </div>
                                </div>
                            </button> 
                        </form>
                    </div>
                @endif
                <div class="more_box ml_66">
                    <div class="action_box">
                        <!--いいね-->
                        <div class="like_box">
                            @if($post->isLikedBy(auth()->user()))
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <img src="{{ asset('/img/liked.png') }}" class="action">
                                    </button>
                                </form>
                            @else
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <img src="{{ asset('/img/like.png') }}" class="action">
                                    </button>
                                </form>
                            @endif
                            <p class="count">{{ $post->likes->count() }}</p>
                        </div>
                        <!--コメント-->
                        <div class="comment_box">
                            <div>
                                <img src="{{ asset('/img/chat.png') }}" class="action">
                            </div>
                            <p class="count">{{ $post->comments->count() }}</p>
                        </div>
                    </div> <!--action_box-->
                    <div class="view_box"> <!--view_box-->
                        <a href="/posts/{{ $post->id }}" class="visited">
                            <p class="view">投稿を見る</p>
                            <div>
                                <img src="{{ asset('/img/chevron-right.svg') }}" class="right">
                            </div>
                        </a>
                    </div> <!--view_box-->
                </div>
            
            @elseif ($post->category_id == 5 || $post->category_id == 6) <!--雑談、相談-->
                <div class="container">
                    @if($post->user->image_path)
                        <div>
                            <img src="{{ $post->user->image_path }}" class="pic">
                        </div>
                    @else
                        <div class="img_box">
                            <img src="{{ asset('/img/feather.svg') }}" class="icon">
                        </div>
                    @endif
                    <div> <!--piyo-->
                        <div class="data">
                            <p class="name">
                                <a href="/profile/show/{{ $post->user->id }}" class="visited">
                                    {{ $post->user->name }}
                                </a>
                            </p>
                            @if ($post->updated_at != $post->created_at)
                                <p class="date">編集済み: {{ $post->updated_at }}</p>
                            @else
                                <p class="date">{{ $post->created_at }}</p>
                            @endif
                        </div> <!--data-->
                        <p class="detail">{{ $post->category->name }}</p>
                        <p class="body">{{ $post->body }}</p>
                    </div> <!--piyo-->
                    <div class="option_box">
                        <div>
                             <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})">
                                    <img src="{{ asset('/img/bin.svg') }}" class="option">
                                </button> 
                            </form>
                        </div>
                        <div>
                            <a href="/posts/{{ $post->id }}/edit">
                                <img src="{{ asset('/img/edit.svg') }}" class="option">
                            </a>
                        </div>
                    </div> <!--option_box-->
                </div> <!--container-->
                @if($post->post_picture_path)
                    <div class="post_pic_box">
                        <div>
                            <img src="{{ $post->post_picture_path }}" alt="画像が読み込めません。" class="post_pic">
                        </div>
                        <form action="/posts/picture/{{ $post->id }}" id="post_picture_path" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePostPicture()">
                                <div class="circle-container">
                                    <div class="circle-box">
                                        <img src="{{ asset('/img/close.svg') }}" class="delete">
                                    </div>
                                </div>
                            </button> 
                        </form>
                    </div>
                @endif
                <div class="more_box ml_66">
                    <div class="action_box">
                        <!--いいね-->
                        <div class="like_box">
                            @if($post->isLikedBy(auth()->user()))
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <img src="{{ asset('/img/liked.png') }}" class="action">
                                    </button>
                                </form>
                            @else
                                <form action="/posts/{{ $post->id }}/like" method="POST">
                                    @csrf
                                    <button type="submit">
                                        <img src="{{ asset('/img/like.png') }}" class="action">
                                    </button>
                                </form>
                            @endif
                            <p class="count">{{ $post->likes->count() }}</p>
                        </div>
                        <!--コメント-->
                        <div class="comment_box">
                            <div>
                                <img src="{{ asset('/img/chat.png') }}" class="action">
                            </div>
                            <p class="count">{{ $post->comments->count() }}</p>
                        </div>
                    </div> <!--action_box-->
                    <div class="view_box"> <!--view_box-->
                        <a href="/posts/{{ $post->id }}" class="visited">
                            <p class="view">投稿を見る</p>
                            <div>
                                <img src="{{ asset('/img/chevron-right.svg') }}" class="right">
                            </div>
                        </a>
                    </div> <!--view_box-->
                </div>
                
                {{--<div>-->
                <!--    <img src="{{ asset('/img/more.png') }}" class="more" onclick="togglePopup()">-->
                <!--</div>-->
                <!--<div id="popup" class="popup" style="display: none;">-->
                <!--    <div class="popup-content">-->
                <!--        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">-->
                <!--            @csrf-->
                <!--            @method('DELETE')-->
                <!--            <button type="button" onclick="deletePost({{ $post->id }})">削除</button> -->
                <!--        </form>-->
                <!--        <div class="edit">-->
                <!--            <a href="/posts/{{ $post->id }}/edit">編集</a>-->
                <!--        </div>-->
                <!--        <button onclick="togglePopup()">Close</button>-->
                <!--    </div>-->
                <!--</div>--}}
            @endif
        </div> <!--posts-->
    @endforeach
    <div class='paginate'>
        {{ $posts->links() }} <!--ペジネーション-->
    </div>
    </div>
    
    <div class="sp_button">
        <x-post-button />
    </div>
    
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