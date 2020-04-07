<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prepayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prepayment', function (Blueprint $table) {
            $table->Increments('pre_id');
            $table->integer('user_id');
            $table->time('per_time')->nullable();
            $table->double('per_total')->nullable();
            $table->text('per_desc')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('prepayment');
    }
}
