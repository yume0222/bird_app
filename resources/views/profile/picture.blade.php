<!DOCTYPE HTML> <!--お気に入りの鳥写真-->
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
    </head>
    <body>
        <form action="/profile/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="bird_img_path" :value="__('お気に入りの鳥写真')" />
                <div class="image">
                    <input type="file" name="bird_img_path" :value="old('bird_img_path', $bird_picture->bird_img_path)" autofocus autocomplete="bird_img_path" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('bird_img_path')" />
            </div>
            <input type="submit" value="store"/>
        </form>
    </body>
</html>