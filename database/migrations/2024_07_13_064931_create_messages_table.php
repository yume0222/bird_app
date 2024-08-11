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
        Schema::create('messages', function (Blueprint $table) { //メッセージの情報
            $table->id();
            $table->string('message');
            $table->timestamps(); //作成日時
            //'chat_id' は 'chatsテーブル' の 'id' を参照する外部キー
            $table->foreignId('chat_id')->constrained();
            //'user_id' は 'usersテーブル' の 'id' を参照する外部キー
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
