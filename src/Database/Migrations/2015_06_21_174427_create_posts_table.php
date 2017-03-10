<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->text('content_raw');
            $table->text('content_html');
            $table->string('page_image')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_draft')->default(false);
            $table->string('layout')->default('vendor.easel.frontend.blog.post');
            $table->integer('author_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable()->index();
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
