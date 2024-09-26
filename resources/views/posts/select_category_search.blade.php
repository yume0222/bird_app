<x-app-layout><!--検索・カテゴリー選択画面-->
    <link rel="stylesheet" href="{{ asset('/css/category/style.css') }}">

    <h1>Search</h1>
    <p>カテゴリー選択</p>
    <div class="body">
        @foreach($categories as $category)
            <div class="container">
                <li>
                    <a href="/search/category/{{ $category->id }}" class="visited">{{ $category->name }}</a>
                </li>
                @if ($category->id == 1)
                    <small>pet bird</small>
                @elseif ($category->id == 2)
                    <small>wild bird</small>
                @elseif ($category->id == 3)
                    <small>event</small>
                @elseif ($category->id == 4)
                    <small>lost bird</small>
                @elseif ($category->id == 5)
                    <small>free</small>
                @elseif ($category->id == 6)
                    <small>themes</small>
                @endif
            </div>
        @endforeach
    </div>
    
    <div class="sp_button">
        <x-post-button />
    </div>
</x-app-layout>