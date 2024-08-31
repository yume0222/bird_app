<x-app-layout><!--お気に入りの鳥写真-->
        <form action="/profile/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="bird_img_path" :value="__('お気に入りの鳥写真')" />
                <div class="image">
                    <input type="file" name="bird_img_path" id="bird_img_path" onchange="previewImage(event)" autofocus autocomplete="bird_img_path" />
                    <img id="image-preview" style="display:none; width: 200px; height: 200px;" alt="画像のプレビュー" />
                </div>
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                    <img src="{{ asset('images/' . session('image')) }}" alt="アップロードされた画像" style="width: 200px; height: 200px;">
                @endif
                <x-input-error class="mt-2" :messages="$errors->get('bird_img_path')" />
            </div>
            <input type="submit" value="保存"/>
        </form>
        
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