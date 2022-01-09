<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {      
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->text('picture')->nullable();
            $table->text('password');
            $table->rememberToken();
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
        Schema::dropIfExists('customer');
    }
}
