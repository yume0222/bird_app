<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest; //PostRequest
use App\Models\Post; //Postモデルをインポート
use App\Models\Category; //Categoryモデルをインポート
use App\Models\PetBirdPost; //PetBirdPostモデルをインポート
use App\Models\WildBirdPost; //WildBirdPostモデルをインポート
use App\Models\EventPost; //EventPostモデルをインポート
use App\Models\LostBirdPost; //LostBirdPostモデルをインポート
use App\Models\Prefecture; //Prefectureモデルをインポート
use App\Models\User; //Userモデルをインポート
use App\Models\Comment; //Commentモデルをインポート
use Illuminate\Support\Facades\Auth; //Auth
use Cloudinary; //画像


class PostController extends Controller
{
    public function index(Post $post, Category $category, PetBirdPost $pet_bird_post, WildBirdPost $wild_bird_post, Prefecture $prefecture, EventPost $event_post, LostBirdPost $lost_bird_post) //投稿一覧
    {
        $category = $post->category_id;
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(), 'category' => $category, 'pet_bird_posts' => $pet_bird_post->get(), 'wild_bird_posts' => $wild_bird_post->get(), 'event_posts' => $event_post->get(), 'lost_bird_posts' => $lost_bird_post->get(), 'prefecture' => $prefecture]); //ペジネーション
    }
    
    public function show(Post $post, PetBirdPost $pet_bird_post)
    {
        $category = $post->category_id;
        $prefecture_get = null;
        $wild_bird_post = null;
        $event_post = null;
        $lost_bird_post = null;
    
        if (in_array($category, [2, 3, 4])) {
            switch ($category) {
                case 2:
                    $wild_bird_post = WildBirdPost::where('post_id', $post->id)->first();
                    $prefecture_id = $wild_bird_post->prefecture_id;
                    break;
                case 3:
                    $event_post = EventPost::where('post_id', $post->id)->first();
                    $prefecture_id = $event_post->prefecture_id;
                    break;
                case 4:
                    $lost_bird_post = LostBirdPost::where('post_id', $post->id)->first();
                    $prefecture_id = $lost_bird_post->prefecture_id;
                    break;
            }
            $prefecture_get = Prefecture::find($prefecture_id);
        }

        return view('posts.show')->with([
            'post' => $post,
            'category' => $category,
            'pet_bird_post' => $pet_bird_post,
            'prefecture' => $prefecture_get,
            'wild_bird_post' => $wild_bird_post,
            'event_post' => $event_post,
            'lost_bird_post' => $lost_bird_post
        ]);
    }

    public function select(Category $category) //投稿作成にカテゴリー名を表示
    {
        return view('posts.select_category')->with(['categories' => $category->get()]);
    }
    
    public function create(Category $category, Post $post, PetBirdPost $pet_bird_post, LostBirdPost $lost_bird_post, Prefecture $prefecture) //投稿作成
    {
        return view('posts.create')->with(['posts' => $post, 'category' => $category, 'pet_bird_posts' => $pet_bird_post->get(), 'lost_bird_posts' => $lost_bird_post->get(), 'prefectures' => $prefecture->get()]);
    }
    
    public function store(Request $request, Post $post, Category $category, PetBirdPost $pet_bird_post, WildBirdPost $wild_bird_post, Prefecture $prefecture, EventPost $event_post, LostBirdPost $lost_bird_post)
    {
        $categoryId = $category->id;
        
        $input = $request->all();
        $input = $request->validate([
            'post.body' => 'required|string|max:255',
        ]);
        $input['post']['user_id'] = Auth::id();
        $input['post']['category_id'] = $categoryId;
        $new_post = Post::create($input['post']);
        
        if($request->file('image')){ //画像ファイルが送られた時だけ処理が実行
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input['post']['post_picture_path'] = $image_url;
        }
        
        switch ($categoryId) {
            case 1:
                $input = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'pet_bird_post.type' => 'required|string|max:100',
                    'pet_bird_post.personality' => 'required|string|max:100',
                    'pet_bird_post.special_skil' => 'required|string|max:100',
                ]);
                $petBirdInput = $input['pet_bird_post'];
                $petBirdInput['post_id'] = $new_post->id;
                $pet_bird_post_input = $request['pet_bird_post'];
                $petBirdInput['birthday'] = $pet_bird_post_input['birthday'];
                $petBirdInput['gender'] = $pet_bird_post_input['gender'];
                $pet_bird_post->fill($petBirdInput)->save();
                break;
            case 2:
                $input = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'wild_bird_post.type' => 'required|string|max:100',
                    'wild_bird_post.location_detail' => 'required|string|max:100',
                    'wild_bird_post.prefecture' => 'required',
                ]);
                $wildBirdInput = $input['wild_bird_post'];
                $wildBirdInput['post_id'] = $new_post->id;
                $wildBirdInput['prefecture_id'] = $input['wild_bird_post']['prefecture'];
                $wild_bird_post->fill($wildBirdInput)->save();
                break;
            case 3:
                $input = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'event_post.name' => 'required|string|max:100',
                    'event_post.start_date' => 'required',
                    'event_post.location_detail' => 'required|string|max:100',
                    'event_post.prefecture' => 'required',
                ]);
                $eventInput = $input['event_post'];
                $eventInput['post_id'] = $new_post->id;
                $eventInput['prefecture_id'] = $input['event_post']['prefecture'];
                $event_post->fill($eventInput)->save();
                break;
            case 4:
                $input = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'lost_bird_post.discovery_date' => 'required',
                    'lost_bird_post.text' => 'required',
                    'lost_bird_post.location_detail' => 'required|string|max:100',
                    'lost_bird_post.characteristics' => 'required|string|max:100',
                    'lost_bird_post.type' => 'required|string|max:100',
                    'lost_bird_post.prefecture' => 'required',
                ]);
                $lostdBirdInput = $input['lost_bird_post'];
                $lostdBirdInput['post_id'] = $new_post->id;
                $lostdBirdInput['prefecture_id'] = $input['lost_bird_post']['prefecture'];
                $lost_bird_post->fill($lostdBirdInput)->save();
                break;
            case 5:
                $input = $request->validate([
                    'post.body' => 'required|string|max:255',
                ]);
                break;
            case 6:
                $input = $request->validate([
                    'post.body' => 'required|string|max:255',
                ]);
                break;
        }
        
        return redirect('/posts/' . $new_post->id);
    }
    
    public function edit(Category $category, Post $post, PetBirdPost $pet_bird_post, LostBirdPost $lost_bird_post, EventPost $event_post, WildBirdPost $wild_bird_post, Prefecture $prefecture) //編集画面表示
    {
        $category = $post->category_id;
       
        return view('posts.edit')->with(['post' => $post, 'category' => $category, 'pet_bird_posts' => $pet_bird_post->get(), 'lost_bird_posts' => $lost_bird_post->get(), 'prefectures' => $prefecture->get()]);
    }
    
    public function update(Request $request, Post $post, Category $category, PetBirdPost $pet_bird_post, WildBirdPost $wild_bird_post, Prefecture $prefecture, EventPost $event_post, LostBirdPost $lost_bird_post) //編集実行
    {
        $categoryId = $post->category_id;

        $input_post = $request->all();
        $input = $request->validate([
            'post.body' => 'required|string|max:255',
        ]);
        $post->updated_at = now();
        $post->update(['body' => $input_post['post']['body']]);
        
        if ($request->file('image')) {
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $post->update(['post_picture_path' => $image_url]);
        }
        
        switch ($categoryId) {
            case 1:
                $input_post = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'post.post_picture_path' => 'nullable',
                    'pet_bird_post.id' => 'required',
                    'pet_bird_post.type' => 'required|string|max:100',
                    'pet_bird_post.personality' => 'required|string|max:100',
                    'pet_bird_post.special_skil' => 'required|string|max:100',
                ]);
                $petBirdInput = $input_post['pet_bird_post'];
                $petBirdInput['post_id'] = $post->id;
                $pet_bird_post_input = $request['pet_bird_post'];
                $petBirdInput['birthday'] = $pet_bird_post_input['birthday'];
                $petBirdInput['gender'] = $pet_bird_post_input['gender'];
                $pet_bird_post = $pet_bird_post->where('id', '=', $petBirdInput['id'])->first();
                $pet_bird_post->fill($petBirdInput)->save();
                break;
            case 2:
                $input_post = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'wild_bird_post.id' => 'required',
                    'wild_bird_post.type' => 'required|string|max:100',
                    'wild_bird_post.location_detail' => 'required|string|max:100',
                    'wild_bird_post.prefecture' => 'required',
                ]);
                $wildBirdInput = $input_post['wild_bird_post'];
                $wildBirdInput['post_id'] = $post->id;
                $wildBirdInput['prefecture_id'] = $input_post['wild_bird_post']['prefecture'];
                $wild_bird_post = $wild_bird_post->where('id', '=', $wildBirdInput['id'])->first();
                $wild_bird_post->fill($wildBirdInput)->save();
                break;
            case 3:
                $input_post = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'event_post.id' => 'required',
                    'event_post.name' => 'required|string|max:100',
                    'event_post.start_date' => 'required',
                    'event_post.location_detail' => 'required|string|max:100',
                    'event_post.prefecture' => 'required',
                ]);
                $eventInput = $input_post['event_post'];
                $eventInput['post_id'] = $post->id;
                $eventInput['prefecture_id'] = $input_post['event_post']['prefecture'];
                $event_post = $event_post->where('id', '=', $eventInput['id'])->first();
                $event_post->fill($eventInput)->save();
                break;
            case 4:
                $input_post = $request->validate([
                    'post.body' => 'required|string|max:255',
                    'lost_bird_post.id' => 'required',
                    'lost_bird_post.discovery_date' => 'required',
                    'lost_bird_post.text' => 'required',
                    'lost_bird_post.location_detail' => 'required|string|max:100',
                    'lost_bird_post.characteristics' => 'required|string|max:100',
                    'lost_bird_post.type' => 'required|string|max:100',
                    'lost_bird_post.prefecture' => 'required',
                ]);
                $lostdBirdInput = $input_post['lost_bird_post'];
                $lostdBirdInput['post_id'] = $post->id;
                $lostdBirdInput['prefecture_id'] = $input_post['lost_bird_post']['prefecture'];
                $lost_bird_post = $lost_bird_post->where('id', '=', $lostdBirdInput['id'])->first();
                $lost_bird_post->fill($lostdBirdInput)->save();
                break;
            case 5:
                $input_post = $request->validate([
                    'post.body' => 'required|string|max:255',
                ]);
                break;
            case 6:
                $input_post = $request->validate([
                    'post.body' => 'required|string|max:255',
                ]);
                break;
        }
        
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post) //削除
    {
        $post->delete();
        return redirect('/');
    }
    
    public function destroyPostPicture(Post $post) //画像削除
    {
        $post = Post::find($post->id);
        $post['post_picture_path'] = null;
        $post->save();
        return redirect('/');
    }
    
    public function categorySearch(Category $category) //検索にカテゴリー名を表示
    {
        return view('posts.select_category_search')->with(['categories' => $category->get()]);
    }
    
    public function search(Category $category, Post $post, PetBirdPost $pet_bird_post, LostBirdPost $lost_bird_post, Prefecture $prefecture) //検索画面
    {
        return view('posts.search')->with(['posts' => $post, 'category' => $category, 'pet_bird_posts' => $pet_bird_post->get(), 'lost_bird_posts' => $lost_bird_post->get(), 'prefectures' => $prefecture->get()]);
    }
    
    public function result(Request $request, Category $category) //検索一覧結果
    {
        $posts = $category->posts()->get();
        $input = $request->all();
        
        switch ($category->id) {
            case 1:
                $pet_bird_posts = [];
                foreach($posts as $post) {
                    $pet_bird_post = $post->pet_bird_post;
                    $check = true;
                    
                    if($input['pet_bird_post']['birthday'] != null && $pet_bird_post->birthday != $input['pet_bird_post']['birthday']) {
                        $check = false;
                    }
                    if($input['pet_bird_post']['keyword'] != null && ( strpos($post->body, $input['pet_bird_post']['keyword']) === false && strpos($pet_bird_post->type, $input['pet_bird_post']['keyword']) === false && strpos($pet_bird_post->personality, $input['pet_bird_post']['keyword']) === false && strpos($pet_bird_post->special_skil, $input['pet_bird_post']['keyword']) === false )) {
                        $check = false;
                    }
                    
                    if($check) {
                        array_push($pet_bird_posts, $post);
                    }
                }
                return view('posts.result')->with(['posts' => $pet_bird_posts]);
                break;
            case 2:
                 $wild_bird_posts = [];
                 foreach($posts as $post) {
                    $wild_bird_post = $post->wild_bird_post;
                    $check = true;
                    
                    if($input['wild_bird_post']['prefecture_id'] != null && $wild_bird_post->prefecture_id != $input['wild_bird_post']['prefecture_id']) {
                        $check = false;
                    }
                    if($input['wild_bird_post']['keyword'] != null && ( strpos($post->body, $input['wild_bird_post']['keyword']) === false && strpos($wild_bird_post->type, $input['wild_bird_post']['keyword']) === false && strpos($wild_bird_post->location_detail, $input['wild_bird_post']['keyword']) === false )) {
                        $check = false;
                    }
                    
                    if($check) {
                        array_push($wild_bird_posts, $post);
                    }
                }
                return view('posts.result')->with(['posts' => $wild_bird_posts]);
                break;
            case 3:
                 $event_posts = [];
                 foreach($posts as $post) {
                    $event_post = $post->event_post;
                    $check = true;
                    
                    if($input['event_post']['start_date'] != null && $event_post->start_date != $input['event_post']['start_date']) {
                        $check = false;
                    }
                    if($input['event_post']['prefecture_id'] != null && $event_post->prefecture_id != $input['event_post']['prefecture_id']) {
                        $check = false;
                    }
                    if($input['event_post']['keyword'] != null && ( strpos($post->body, $input['event_post']['keyword']) === false && strpos($event_post->name, $input['event_post']['keyword']) === false && strpos($event_post->location_detail, $input['event_post']['keyword']) === false )) {
                        $check = false;
                    }
                    
                    if($check) {
                        array_push($event_posts, $post);
                    }
                }
                return view('posts.result')->with(['posts' => $event_posts]);
                break;
            case 4:
                $lost_bird_posts = [];
                foreach($posts as $post) {
                    $lost_bird_post = $post->lost_bird_post;
                    $check = true;
                    
                    if($input['lost_bird_post']['discovery_date'] != null && $lost_bird_post->discovery_date != $input['lost_bird_post']['discovery_date']) {
                        $check = false;
                    }
                    if($input['lost_bird_post']['text'] != null && $lost_bird_post->text != $input['lost_bird_post']['text']) {
                        $check = false;
                    }
                    if($input['lost_bird_post']['prefecture_id'] != null && $lost_bird_post->prefecture_id != $input['lost_bird_post']['prefecture_id']) {
                        $check = false;
                    }
                    if($input['lost_bird_post']['keyword'] != null && ( strpos($post->body, $input['lost_bird_post']['keyword']) === false && strpos($lost_bird_post->type, $input['lost_bird_post']['keyword']) === false && strpos($lost_bird_post->location_detail, $input['lost_bird_post']['keyword']) === false && strpos($lost_bird_post->characteristics, $input['lost_bird_post']['keyword']) === false )) {
                        $check = false;
                    }
                    
                    if($check) {
                        array_push($lost_bird_posts, $post);
                    }
                }
                return view('posts.result')->with(['posts' => $lost_bird_posts]);
                break;
            case 5:
                $bird_post = [];
                foreach($posts as $post) {
                    $lost_bird_post = $post->lost_bird_post;
                    $check = true;
                    
                    if($input['post']['keyword'] != null && ( strpos($post->body, $input['post']['keyword']) === false )) {
                        $check = false;
                    }
                    
                    if($check) {
                        array_push($bird_post, $post);
                    }
                }
                return view('posts.result')->with(['posts' => $bird_post]);
                break;
            case 6:
                $bird_post = [];
                foreach($posts as $post) {
                    $lost_bird_post = $post->lost_bird_post;
                    $check = true;
                    
                    if($input['post']['keyword'] != null && ( strpos($post->body, $input['post']['keyword']) === false )) {
                        $check = false;
                    }
                    
                    if($check) {
                        array_push($bird_post, $post);
                    }
                }
                return view('posts.result')->with(['posts' => $bird_post]);
                break;
        }
    }
    

}
