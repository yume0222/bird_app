<x-app-layout><!--通知-->
<style>
    img {
        width: 20px;
        height: 20px;
    }
</style>
    @foreach($notifications as $notification)
    <div>
        @if($notification->type === 'like')
        @if($notification->user->image_path)
            <div>
                <img src="{{ $notification->user->image_path }}">
            </div>
        @else
            <p>ピヨ</p> <!--仮-->
        @endif
            {{ $notification->data['user_name'] }}さんがあなたの投稿にいいねしました。
            <a href="{{ url('/posts/' . $notification->notifiable_id) }}">投稿を表示</a>
            <a href="{{ url('/profile/show/' . $notification->data['user_id']) }}">ユーザーのプロフィール</a>
            
            
        @elseif($notification->type === 'comment')
        @if($notification->user->image_path)
            <div>
                <img src="{{ $notification->user->image_path }}">
            </div>
        @else
            <p>ピヨ</p> <!--仮-->
        @endif
            {{ $notification->data['user_name'] }}さんがあなたの投稿にコメントしました。
            <a href="{{ url('/posts/' . $notification->notifiable_id) }}">投稿を表示</a>
            <a href="{{ url('/profile/show/' . $notification->data['user_id']) }}">ユーザーのプロフィール</a>
        @endif
    </div>
    @endforeach
    
    {{--@foreach($notifications as $notification)-->
    <!--<div>-->
    <!--    @if($notification->type === 'like')-->
    <!--        <a href="{{ url('/posts/' . $notification->notifiable_id) }}">-->
    <!--            <a href="{{ url('/profile/show/' . $notification->user_id) }}">{{ $notification->data['user_name'] }}</a>さんがあなたの投稿にいいねしました。-->
    <!--        </a>-->
    <!--    @elseif($notification->type === 'comment')-->
    <!--        <a href="{{ url('/posts/' . $notification->notifiable_id) }}">-->
    <!--            <a href="{{ url('/profile/show/' . $notification->user_id) }}">{{ $notification->data['user_name'] }}</a>さんがあなたの投稿にコメントしました。-->
    <!--        </a>-->
    
    <!--    @endif-->
    <!--</div>-->
    <!--@endforeach--}}
</x-app-layout>