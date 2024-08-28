<!DOCTYPE HTML> <!--通知-->
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post</title>
    </head>
    <body>
    @foreach($notifications as $notification)
    <div>
        @if($notification->type === 'like')
            {{ $notification->data['user_name'] }}さんがあなたの投稿にいいねしました。
            <a href="{{ url('/posts/' . $notification->notifiable_id) }}">投稿を表示</a>
            <a href="{{ url('/profile/show/' . $notification->user_id) }}">ユーザーのプロフィール</a>
        @elseif($notification->type === 'comment')
            {{ $notification->data['user_name'] }}さんがあなたの投稿にコメントしました。
            <a href="{{ url('/posts/' . $notification->notifiable_id) }}">投稿を表示</a>
            <a href="{{ url('/profile/show/' . $notification->user_id) }}">ユーザーのプロフィール</a>
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
    </body>
</html>