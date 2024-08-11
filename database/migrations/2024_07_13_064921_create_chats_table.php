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
        Schema::create('chats', function (Blueprint $table) { //チャットルームの情報
            $table->id();
            $table->timestamps(); //作成日時
            //'sender_id' は 'usersテーブル' の 'id' を参照する外部キー
            $table->foreignId('sender_id') ->constrained('users','id');
            //'reciever_id' は 'usersテーブル' の 'id' を参照する外部キー
            $table->foreignId('reciever_id') ->constrained('users','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
