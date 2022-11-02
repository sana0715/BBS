<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;   // Blueprintオブジェクトをここで読み込んでいる
use Illuminate\Support\Facades\Schema;     // Schemaファサードをここから読み込んでいる

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  // 実行(作成) upの中にテーブル定義を書いていく
    {
        // Schemaファサードを使っている (Schema::create = テーブルを作成 という意味)
        Schema::create('users', function (Blueprint $table) {
            // カラムの作成はBlueprintオブジェクトのtableメソッドを使う
            // $table->id();
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()   // 元に戻す(削除)
    {
        Schema::dropIfExists('users');
    }
}
