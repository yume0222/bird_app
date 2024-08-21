<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) { //投稿
            $table->id();
            $table->string('body', 200); //本文
            $table->string('post_picture_path')->nullable(); //画像
            $table->timestamps(); //作成日時、更新日時
            $table->softDeletes(); //削除日時
            //'category_id' は 'categoriesテーブル' の 'id' を参照する外部キー
            $table->foreignId('category_id') ->constrained();
            //'user_id' は 'usersテーブル' の 'id' を参照する外部キー
            $table->foreignId('user_id') ->constrained()->onDelete('cascade');
            //'post_picture_id' は 'post_picturesテーブル' の 'id' を参照する外部キー
            // $table->foreignId('post_picture_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
