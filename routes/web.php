<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; //PostControllerクラスをインポート
use App\Http\Controllers\CategoryController; //CategoryControllerクラスをインポート
use App\Http\Controllers\PetBirdPostController; //PetBirdPostControllerクラスをインポート

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
});

//Route::get('/', function () {
    //return view('welcome');
//});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
