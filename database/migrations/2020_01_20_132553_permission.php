<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Permission', function (Blueprint $table) {
            $table->Increments('Per_id');
            $table->integer('User_id')->nullable();
            $table->dateTime('Per_time')->nullable();
            $table->double('Per_total')->nullable();
            $table->boolean('Per_status')->nullable();
            $table->double('bonus')->nullable(); 
            $table->double('error')->nullable();
            $table->dateTime('day_pay')->nullable();
            $table->integer('qty')->nullable();
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
        Schema::dropIfExists('Permission');
    }
}
