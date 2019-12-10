<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Foreign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images');

        });

        Schema::table('replies', function (Blueprint $table) {
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('target_id')->references('id')->on('users');

        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreign('profile_image')->references('link')->on('images');
        });
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['image_id']);

        });

        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['target_id']);

        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['profile_image']);
        });
    }
}
