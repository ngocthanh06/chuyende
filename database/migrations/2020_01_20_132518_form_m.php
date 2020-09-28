<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FormM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->Increments('form_id');
            $table->string('form_name')->nullable();
            $table->double('form_work')->nullable();
            $table->time('form_time_in')->nullable();
            $table->time('form_time_out')->nullable();
            $table->integer('form_limited')->nullable();
            $table->text('form_desc')->nullable();
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
        Schema::dropIfExists('forms');
    }
}
