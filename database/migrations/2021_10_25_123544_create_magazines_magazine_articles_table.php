<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazinesMagazineArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazines_magazine_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('magazine_id');
            $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');

            $table->unsignedBigInteger('magazine_article_id');
            $table->foreign('magazine_article_id')->references('id')->on('magazine_articles')->onDelete('cascade');
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
        Schema::dropIfExists('magazines_magazine_articles');
    }
}
