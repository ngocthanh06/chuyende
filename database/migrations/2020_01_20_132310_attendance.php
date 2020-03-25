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
        Schema::create('Attendance', function (Blueprint $table) {
            $table->Increments('Att_id');
            $table->integer('Workshifts_id')->nullable();
            $table->text('Att_desc')->nullable();
            $table->dateTime('Att_time')->nullable();
            $table->integer('Att_status')->nullable();
            $table->text('Att_accept')->nullable();
            $table->integer('User_accept')->nullable();
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
        Schema::dropIfExists('Attendance');
    }
}
