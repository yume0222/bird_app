<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; //PostControllerクラスをインポート
use App\Http\Controllers\CategoryController; //CategoryControllerクラスをインポート
use App\Http\Controllers\UserController; //UserControllerクラスをインポート
use App\Http\Controllers\BirdPictureController; ///BirdPicturControllerクラスをインポート
use App\Http\Controllers\CommentController; ///CommentControllerクラスをインポート
use App\Http\Controllers\LikeController; ///LikeControllerクラスをインポート
use App\Http\Controllers\NotificationController; ///NotificationControllerクラスをインポート
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\PostImageUploadController;
use App\Http\Controllers\BirdImageUploadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index'); //投稿一覧
    Route::post('/posts/{category}', 'store')->name('store'); //投稿作成で投稿ボタンを押された時
    Route::get('/posts/category', 'select')->name('select'); //投稿作成にカテゴリー名を表示
    Route::get('/posts/{post}', 'show')->name('show'); //投稿詳細
    Route::get('/posts/category/{category}', 'create')->name('create'); //投稿作成
    Route::get('/posts/{post}/edit', 'edit')->name('edit'); //編集画面表示
    Route::put('/posts/{post}', 'update')->name('update'); //編集実行
    Route::delete('/posts/{post}', 'delete')->name('delete'); //削除
    Route::delete('/posts/picture/{post}', 'destroyPostPicture')->name('destroy_post_picture'); //投稿画像削除
    
    Route::get('/search/category', 'categorySearch')->name('search.select_category'); //検索にカテゴリー名を表示
    Route::get('/search/category/{category}', 'search')->name('search'); //検索画面
    Route::post('/search/category/{category}/result', 'result')->name('search.result'); //検索結果一覧
});
Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    Route::post('/posts/{post}/comment', 'comment')->name('comment'); //コメント保存
    Route::get('/posts/{post}/{comment}/edit', 'editComment')->name('comment.edit'); //コメント編集画面表示
    Route::put('/posts/comment/{comment}/update', 'updateComment')->name('comment.update'); //コメント編集実行
    Route::delete('/posts/comment/{comment}', 'deleteComment')->name('comment.delete'); //コメント削除
});
Route::controller(LikeController::class)->middleware(['auth'])->group(function(){
    Route::post('/posts/{post}/like', 'like')->name('like.store'); //いいね保存
    Route::delete('/posts/{post}/like', 'destroy')->name('like.destroy'); //いいね解除
});

Route::controller(NotificationController::class)->middleware(['auth'])->group(function(){
    Route::get('/notifications', 'notification')->name('notification'); //通知
});
Route::controller(ImageUploadController::class)->middleware(['auth'])->group(function(){
    Route::post('/image/upload', 'upload')->name('image.upload'); //プロフィール画像
});
// Route::controller(PostImageUploadController::class)->middleware(['auth'])->group(function(){
//     Route::post('/post/image/upload', 'upload')->name('post_image.upload'); //投稿画像
// });
// Route::controller(BirdImageUploadController::class)->middleware(['auth'])->group(function(){
//     Route::post('/bird/image/upload', 'upload')->name('bird_image.upload'); //お気に入りの鳥画像
// });

//Route::get('/', function () {
    //return view('welcome');
//});

Route::middleware('auth')->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show'); //プロフィール表示
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); //プロフィール編集画面表示
    Route::get('/profile/show/{user}', [ProfileController::class, 'showUser'])->name('profile.show_user'); //各ユーザのプロフィール表示
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/picture', [BirdPictureController::class, 'picture'])->name('profile.picture'); //画像登録画面表示
    Route::post('/profile/store', [BirdPictureController::class, 'store'])->name('profile.store'); //画像保存
    Route::delete('/bird_pictures/{id}', [BirdPictureController::class, 'destroyBirdPicture'])->name('profile.destroy_bird_picture'); //お気に入りの鳥画像削除
    Route::delete('/profile_picture/{user}', [ProfileController::class, 'destroyProfilePicture'])->name('profile.destroy_profile_picture'); //プロフィール画像削除
});

require __DIR__.'/auth.php';
