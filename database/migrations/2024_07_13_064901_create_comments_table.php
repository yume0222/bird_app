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
        Schema::create('comments', function (Blueprint $table) { //コメント
            $table->id();
            $table->string('comment', 200); //コメント本文
            $table->timestamps(); //作成日時、更新日時
            $table->softDeletes(); //削除日時
            //'user_id' は 'usersテーブル' の 'id' を参照する外部キー
            $table->foreignId('user_id') ->constrained()->onDelete('cascade');
            //'post_id' は 'postsテーブル' の 'id' を参照する外部キー
            $table->foreignId('post_id') ->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
