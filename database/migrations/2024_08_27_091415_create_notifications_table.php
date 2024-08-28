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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('type'); //通知のタイプ
            $table->unsignedBigInteger('notifiable_id'); //通知に関連するモデルのID
            $table->string('notifiable_type');  //通知に関連するモデルのクラス名
            $table->text('data'); //通知の詳細データを格納
            $table->timestamp('read_at')->nullable(); //通知が既読になった日時（未読の場合はnull）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
