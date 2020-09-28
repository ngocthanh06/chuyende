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
        Schema::create('workshifts', function (Blueprint $table) {
            $table->Increments('work_id');
            $table->integer('form_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->time('ws_time_in')->nullable();
            $table->time('ws_time_out')->nullable();
            $table->date('ws_date')->nullable();
            $table->text('work_desc')->nullable();
            $table->boolean('work_active')->nullable();
            $table->boolean('status')->nullable()->default(0);
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
        Schema::dropIfExists('workshifts');
    }
}
