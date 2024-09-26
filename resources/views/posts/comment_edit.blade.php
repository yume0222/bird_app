<x-app-layout><!--コメント編集-->
    <link rel="stylesheet" href="{{ asset('/css/comment_edit/style.css') }}">
    
    <div class="header">
        <div>
            <a href="/">
                <img src="{{ asset('/img/arrow_back.png') }}" class="back">
            </a>
        </div>
        <h1>Post</h1>
    </div>
    <p>コメントを編集</p>
    <form action="/posts/comment/{{ $commentId }}/update" method="POST"> 
        @csrf
        @method('PUT')
        <textarea name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
        <p class="body__error" style="color:red">{{ $errors->first('comment') }}</p>
        <div class="submit_box">
            <button type="submit">保存する</button>
        </div>
    </form>
    
    <div class="sp_button">
        <x-post-button />
    </div>
</x-app-layout>