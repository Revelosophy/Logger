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
            $table->bigIncrements('id')->unsigned();
            $table->timestamps();
            $table->string('text');
            $table->string('poster');
            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->bigInteger('poster_id')->unsigned()->nullable();
            $table->foreign('poster_id')->references('id')->on('users')->onDelete('cascade');


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
    }
}
