<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Attendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->Increments('att_id');
            $table->integer('workshifts_id')->nullable();
            $table->text('att_desc')->nullable();
            $table->dateTime('att_time')->nullable();
            $table->integer('att_status')->nullable();
            $table->text('att_accept')->nullable();
            $table->integer('user_accept')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
