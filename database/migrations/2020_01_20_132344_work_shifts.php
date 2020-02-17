<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WorkShifts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('WorkShifts', function (Blueprint $table) {
            $table->Increments('Work_id');
            $table->integer('FormM_id')->nullable();
            $table->integer('User_id')->nullable();
            $table->time('WS_time_in')->nullable();
            $table->time('WS_time_out')->nullable();
            $table->date('WS_date')->nullable();
            $table->text('Work_desc')->nullable();
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
        Schema::dropIfExists('WorkShifts');
    }
}
