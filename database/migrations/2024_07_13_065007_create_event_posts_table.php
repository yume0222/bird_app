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
        Schema::create('event_posts', function (Blueprint $table) { //イベント
            $table->id();
            $table->string('name', 50); //イベント名
            $table->date('start_date'); //イベント開催日(ドロップダウン)
            $table->string('location_detail', 100); //イベントを開催する詳細場所
            $table->timestamps(); //作成日時、更新日時
            $table->softDeletes(); //削除日時
            //'user_id' は 'postsテーブル' の 'id' を参照する外部キー
            $table->foreignId('post_id') ->constrained()->onDelete('cascade');
            //'prefecture_id' は 'prefecturesテーブル' の 'id' を参照する外部キー
            $table->foreignId('prefecture_id') ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_posts');
    }
};
