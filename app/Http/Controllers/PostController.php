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
        if($request->file('image')){ //画像ファイルが送られた時だけ処理が実行
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input['post']['post_picture_path'] = $image_url;
        }
        $input['post']['user_id'] = Auth::id();
        $input['post']['category_id'] = $categoryId;
        $new_post = Post::create($input['post']);
        
        switch ($categoryId) {
            case 1:
                $input = $request->validate([
                    'post.body' => 'required|string|min:1|max:200',
                    'pet_bird_post.type' => 'required|string|min:1|max:50',
                    'pet_bird_post.personality' => 'required|string|min:1|max:100',
                    'pet_bird_post.special_skil' => 'required|string|min:1|max:100',
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
                    'post.body' => 'required|string|min:1|max:200',
                    'wild_bird_post.type' => 'required|string|min:1|max:50',
                    'wild_bird_post.location_detail' => 'required|string|min:1|max:100',
                    'wild_bird_post.prefecture' => 'required',
                ]);
                $wildBirdInput = $input['wild_bird_post'];
                $wildBirdInput['post_id'] = $new_post->id;
                $wildBirdInput['prefecture_id'] = $input['wild_bird_post']['prefecture'];
                $wild_bird_post->fill($wildBirdInput)->save();
                break;
            case 3:
                $input = $request->validate([
                    'post.body' => 'required|string|min:1|max:200',
                    'event_post.name' => 'required|string|min:1|max:50',
                    'event_post.start_date' => 'required',
                    'event_post.location_detail' => 'required|string|min:1|max:100',
                    'event_post.prefecture' => 'required',
                ]);
                $eventInput = $input['event_post'];
                $eventInput['post_id'] = $new_post->id;
                $eventInput['prefecture_id'] = $input['event_post']['prefecture'];
                $event_post->fill($eventInput)->save();
                break;
            case 4:
                $input = $request->validate([
                    'post.body' => 'required|string|min:1|max:200',
                    'lost_bird_post.discovery_date' => 'required',
                    'lost_bird_post.text' => 'required',
                    'lost_bird_post.location_detail' => 'required|string|min:1|max:100',
                    'lost_bird_post.characteristics' => 'required|string|min:1|max:100',
                    'lost_bird_post.type' => 'required|string|min:1|max:50',
                    'lost_bird_post.prefecture' => 'required',
                ]);
                $lostdBirdInput = $input['lost_bird_post'];
                $lostdBirdInput['post_id'] = $new_post->id;
                $lostdBirdInput['prefecture_id'] = $input['lost_bird_post']['prefecture'];
                $lost_bird_post->fill($lostdBirdInput)->save();
                break;
            case 5:
                $input = $request->validate([
                    'post.body' => 'required|string|min:1|max:200',
                ]);
                break;
            case 6:
                $input = $request->validate([
                    'post.body' => 'required|string|min:1|max:200',
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
        $post->update(['body' => $input_post['post']['body']]);
        
    
        if ($request->file('image')) {
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input_post['post']['image'] = $image_url;
        }
        $post->update(['post_picture_path' => $input_post['post']['post_picture_path']]);
        
    
        
        switch ($categoryId) {
            case 1:
                $input_post = $request->validate([
                    'post.body' => 'required|string|min:1|max:200',
                    'post.post_picture_path' => 'nullable',
                    'pet_bird_post.id' => 'required',
                    'pet_bird_post.type' => 'required|string|min:1|max:50',
                    'pet_bird_post.personality' => 'required|string|min:1|max:100',
                    'pet_bird_post.special_skil' => 'required|string|min:1|max:100',
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
                    'post.body' => 'required|string|min:1|max:200',
                    'wild_bird_post.id' => 'required',
                    'wild_bird_post.type' => 'required|string|min:1|max:50',
                    'wild_bird_post.location_detail' => 'required|string|min:1|max:100',
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
                    'post.body' => 'required|string|min:1|max:200',
                    'event_post.id' => 'required',
                    'event_post.name' => 'required|string|min:1|max:50',
                    'event_post.start_date' => 'required',
                    'event_post.location_detail' => 'required|string|min:1|max:100',
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
                    'post.body' => 'required|string|min:1|max:200',
                    'lost_bird_post.id' => 'required',
                    'lost_bird_post.discovery_date' => 'required',
                    'lost_bird_post.text' => 'required',
                    'lost_bird_post.location_detail' => 'required|string|min:1|max:100',
                    'lost_bird_post.characteristics' => 'required|string|min:1|max:100',
                    'lost_bird_post.type' => 'required|string|min:1|max:50',
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
                    'post.body' => 'required|string|min:1|max:200',
                ]);
                break;
            case 6:
                $input_post = $request->validate([
                    'post.body' => 'required|string|min:1|max:200',
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
    
    public function categorySearch(Category $category) //検索にカテゴリー名を表示
    {
        return view('posts.select_category_search')->with(['categories' => $category->get()]);
    }
    
    public function search(Category $category, Post $post, PetBirdPost $pet_bird_post, LostBirdPost $lost_bird_post, Prefecture $prefecture) //検索画面
    {
        return view('posts.search')->with(['posts' => $post, 'category' => $category, 'pet_bird_posts' => $pet_bird_post->get(), 'lost_bird_posts' => $lost_bird_post->get(), 'prefectures' => $prefecture->get()]);
    }
    
    public function result(Request $request, Category $category, Post $post) //検索一覧結果
    {
        $categoryId = $post->category_id;
        
        switch ($categoryId) {
            case 4:
                $request->validate([
                'lost_bird_post.text' => 'nullable',
                'lost_bird_post.discovery_date' => 'nullable',
                'lost_bird_post.prefecture' => 'nullable',
                'keyword' => 'nullable|string|max:255',
            ]);
            $discovery_date = $request->input('lost_bird_post.discovery_date');
            $text = $request->input('lost_bird_post.text');
            $prefecture = $request->input('lost_bird_post.prefecture');
            $keyword = $request->input('keyword');
            
            $lost_bird_posts = Post::query();
            if (!empty($discovery_date)) {
                $lost_bird_posts->whereHas('lost_bird_post', function($query) use ($discovery_date) {
                    $query->where('lost_bird_post.discovery_date', $discovery_date);
                });
            }
            
            if (!empty($text)) {
                $lost_bird_posts->whereHas('lost_bird_post', function($query) use ($text) {
                    $query->where('lost_bird_post.discovery_date', $text);
                });
            }
            if (!empty($prefecture)) {
                $lost_bird_posts->whereHas('lost_bird_post', function($query) use ($prefecture) {
                    $query->where('lost_bird_post.prefecture.name', $prefecture);
                });
            }
            if (!empty($keyword)) {
                $lost_bird_posts->whereHas('lost_bird_post', function($query) use ($keyword) {
                    $query->where('lost_bird_post.location_detail', $keyword, 'LIKE', '%' . $keyword . '%')
                          ->where('lost_bird_post.type', $keyword, 'LIKE', '%' . $keyword . '%')
                          ->where('lost_bird_post.characteristics', $keyword, 'LIKE', '%' . $keyword . '%')
                          ->where('post.body', $keyword, 'LIKE', '%' . $keyword . '%');
                });
            }
            $lost_bird_post_ids = $lost_bird_posts->pluck('id');
            $posts = Post::whereIn('id', $lost_bird_post_ids)->get();
            break;
        }
        return view('posts.result', ['posts' => $posts->getPaginateByLimit()]);
    }
    
    
}
