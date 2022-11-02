<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->foreignId('user_id');   // usersテーブルのユーザーID(ID）と繋がるカラム
            // 他のテーブルのID参照する場合は[foreignId]というデータ型を使用
            $table->foreignId('category_id');
            $table->text('content');
            $table->text('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');

        // 取り消し処理を行う場合、↓の部分を見て取り消しを行っていく。だから、↓が空っぽだと取り消せない。
        // Schema::table('posts', function (Blueprint $table) {
        //     $table->dropColumn('user_id');
        // });
    
    }
}
