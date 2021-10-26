<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazineArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazine_articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->binary('image');
            $table->timestamps();

            $table->unsignedBigInteger('magazine_id');
            $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazine_articles');
    }
}
