<!DOCTYPE HTML> <!--投稿作成・カテゴリー選択画面-->
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post</title>
    </head>
    <body>
        <h1>Post</h1>
            <div class="body">
                <p>カテゴリー</p>
                @foreach($categories as $category)
                    <li><a href="/posts/category/{{ $category->id }}">{{ $category->name }}</a></li>
                @endforeach
            </div>
        <div class='footer'>
            <a href="/">戻る</a> <!--戻る-->
        </div>
    </body>
</html>