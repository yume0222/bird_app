<x-app-layout>
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
</x-app-layout>