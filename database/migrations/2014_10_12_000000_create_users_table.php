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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15); //名前
            $table->string('self_introduction', 255)->nullable(); //自己紹介
            $table->integer('gender')->nullable(); //性別(ラジオボタン)
            $table->integer('age')->nullable(); //年齢(ドロップダウン)
            $table->string('favorite_bird', 255)->nullable(); //質問・好きな鳥
            $table->string('my_pet', 255)->nullable(); //質問・愛鳥
            $table->string('bird_watching', 255)->nullable(); //質問・鳥見場所
            $table->string('image_path')->nullable(); // プロフィール画像
            $table->timestamps(); //作成日時、更新日時
            $table->string('password'); //パスワード
            $table->string('email')->unique(); //メール
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            //'prefecture_id' は 'prefecturesテーブル' の 'id' を参照する外部キー
            $table->foreignId('prefecture_id')->nullable()->constrained();
            //'bird_picture_id' は 'bird_picturesテーブル' の 'id' を参照する外部キー
            //$table->foreignId('bird_picture_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
