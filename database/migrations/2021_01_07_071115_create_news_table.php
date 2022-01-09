<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id('id_news');
            $table->unsignedBigInteger('id_category')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamp('created_at');
            $table->string('title', 100);
            $table->text('thumbnail')->nullable();
            $table->text('content');
            $table->unsignedTinyInteger('is_recommended')->default(0);
            $table->foreign('id_category')->references('id_category')->on('category')->onDelete('set null');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
