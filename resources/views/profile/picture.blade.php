<x-app-layout><!--お気に入りの鳥写真-->
    <link rel="stylesheet" href="{{ asset('/css/bird_picture/style.css') }}">
    
    <div class="header">
        <div>
            <a href="/">
                <img src="{{ asset('/img/arrow_back.png') }}" class="back">
            </a>
        </div>
        <h1>Profile</h1>
    </div>
    <div class="container">
        <form action="/profile/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="bird_img_path" :value="__('お気に入りの鳥写真')" class="title" />
                <div class="image">
                    <input type="file" name="bird_img_path" id="bird_img_path" onchange="previewImage(event)" autofocus autocomplete="bird_img_path" />
                    <img id="image-preview" style="display:none; width: 200px; height: 200px;" alt="画像のプレビュー" />
                </div>
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                    <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" class="upload">
                @endif
                <x-input-error class="mt-2" :messages="$errors->get('bird_img_path')" />
            </div>
            <div class="store_box">
                <input type="submit" value="保存する" class="store" />
             </div>
        </form>
    </div>
    <div class="sp_button">
        <x-post-button />
    </div>
    
    <script>
        function previewImage(event) { 
            var reader = new FileReader();
            reader.onload = function(){ 
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        } 
    </script>
</x-app-layout>