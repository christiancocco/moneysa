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
            $table->id();
            $table->string('category');
            $table->string('summary');
            $table->longText('body');
            $table->string('title');
            $table->integer('readed')->default(0);
            $table->boolean('is_published')->default(false);
            $table->dateTime('published_date');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('deleted_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('deleted_reason')->nullable();
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
    }
}
