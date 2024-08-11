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
        Schema::create('pet_bird_posts', function (Blueprint $table) { //愛鳥
            $table->id();
            $table->string('type', 50); //愛鳥の種類
            $table->enum('gender', ['雄', '雌'])->nullable(); //愛鳥の性別(ラジオボタン)
            $table->date('birthday')->nullable(); //愛鳥の誕生日（ドロップダウン）
            $table->string('personality', 100); //愛鳥の性格
            $table->string('special_skil', 100); //愛鳥の特技
            $table->timestamps(); //作成日時、更新日時
            $table->softDeletes(); //削除日時
            //'user_id' は 'postsテーブル' の 'id' を参照する外部キー
            $table->foreignId('post_id') ->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_bird_posts');
    }
};
