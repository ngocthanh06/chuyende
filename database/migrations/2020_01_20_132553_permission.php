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
        Schema::create('permissions', function (Blueprint $table) {
            $table->Increments('per_id');
            $table->integer('user_id')->nullable();
            $table->dateTime('per_time')->nullable();
            $table->double('per_total')->nullable();
            $table->boolean('per_status')->nullable();
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
        Schema::dropIfExists('permissions');
    }
}
