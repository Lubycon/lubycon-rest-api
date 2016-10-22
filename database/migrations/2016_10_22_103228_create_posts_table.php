<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('board')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title',45);
            $table->longText('content');
            $table->longText('directory');
            $table->integer('view_count')->unsigned();
            $table->integer('like_count')->unsigned();
            $table->integer('comment_count')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
