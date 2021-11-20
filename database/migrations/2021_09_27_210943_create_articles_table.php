<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('body');
            $table->string('slug');
            $table->string('author');
            $table->string('type');
            $table->boolean('status')->default(0);
            $table->string('image_url')->default('0b0f077382bb1c7ce2b100cc28ca8e1a.png');
            $table->binary('image');
            $table->timestamps();
            $table->unsignedBigInteger('admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
