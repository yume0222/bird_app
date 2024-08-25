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
        Schema::create('lost_bird_posts', function (Blueprint $table) { //迷子
            $table->id();
            $table->date('discovery_date'); //発見日（ドロップダウン）
            $table->boolean('is_bird_owner')->default(false); //ステータス
            $table->boolean('is_bird_rescured')->default(false); //ステータス
            $table->string('text'); //ステータス
            $table->string('location_detail', 100); //迷子鳥がいた詳細場所
            $table->string('characteristics', 100); //特徴
            $table->string('type', 100); //種類
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
        Schema::dropIfExists('lost_bird_posts');
    }
};
