<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTrackerTable extends Migration
{    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_tracker', function (Blueprint $table) {      
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_activity');
            $table->foreign('id_customer')->references('id')->on('customer');
            $table->foreign('id_activity')->references('id')->on('activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_tracker');
    }
}
