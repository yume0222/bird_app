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
        Schema::create('likes', function (Blueprint $table) { //いいね
            $table->id();
            //$table->timestamps();
            //'user_id' は 'usersテーブル' の 'id' を参照する外部キー
            $table->foreignId('user_id') ->constrained('users')->onDelete('cascade');
            //'post_id' は 'postsテーブル' の 'id' を参照する外部キー
            $table->foreignId('post_id') ->constrained('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
