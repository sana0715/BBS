<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();

            $table->id(); //bigIncrements('id')と同じ
            $table->timestamps(); //s複数形でcreated_atとupdated_atを生成

            $table->foreignId('user_id') //usersテーブルの外部キー設定
                ->constrained() //userテーブルのidカラムを参照するconstrainedメソッド
                ->onDelete('cascade'); //削除時のオプション

            $table->foreignId('post_id') //同じことをpostテーブルとも
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
