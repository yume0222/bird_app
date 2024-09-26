<x-app-layout><!--通知-->
    <link rel="stylesheet" href="{{ asset('/css/notion/style.css') }}">
    
    <h1>Notion</h1>
    <div class="mb">
    @foreach($notifications as $notification)
    <div class="container">
        @if($notification->type === 'like' || $notification->type === 'comment')
            @php
                // 通知に関連するユーザーを取得
                $user = \App\Models\User::find($notification->data['user_id']);
            @endphp
            <div class="box">
                <a href="{{ url('/profile/show/' . $user->id) }}">
                    @if($user && $user->image_path)
                        <div>
                            <img src="{{ $user->image_path }}" alt="{{ $user->name }}のプロフィール画像" class="pic">
                        </div>
                    @else
                        <div class="img_box">
                            <img src="{{ asset('/img/feather.svg') }}" class="icon">
                        </div>
                    @endif
                </a>
                
                <div class="inner">
                    @if($notification->type === 'like')
                        <p>
                            <span class="name">
                                <a href="{{ url('/profile/show/' . $user->id) }}" class="visited">{{ $user->name }}さん</a>
                            </span>があなたの投稿にいいねしました。
                            <span class="time sp">{{ $notification->created_at->diffForHumans() }}</span>
                        </p>
                    @elseif($notification->type === 'comment')
                        <p>
                            <span class="name">
                                <a href="{{ url('/profile/show/' . $user->id) }}" class="visited">{{ $user->name }}さん</a>
                            </span>があなたの投稿にコメントしました。
                            <span class="time sp">{{ $notification->created_at->diffForHumans() }}</span>
                        </p>
                    @endif
                    
                    <p class="time pc">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
                
                <div class="more">
                     <a href="{{ url('/posts/' . $notification->notifiable_id) }}">
                         <img src="{{ asset('/img/chevron-right.svg') }}" class="right">
                     </a>
                </div>
            </div>
        @endif
    </div>
    @endforeach
    </div>
    
    <div class="sp_button">
        <x-post-button />
    </div>
</x-app-layout>