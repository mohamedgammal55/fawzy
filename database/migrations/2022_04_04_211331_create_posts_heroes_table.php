<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsHeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name',500)->nullable();
            $table->string('image',500)->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')
                ->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('posts_heroes');
    }
}
