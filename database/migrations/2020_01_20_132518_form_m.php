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
        Schema::create('FormM', function (Blueprint $table) {
            $table->Increments('FormM_id');
            $table->string('FormM_name')->nullable();
            $table->text('FormM_Work')->nullable();
            $table->text('FormM_TimeIn')->nullable();
            $table->text('FormM_TimeOut')->nullable();
            $table->integer('Form_limited')->nullable();
            $table->text('FormM_desc')->nullable();
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
        Schema::dropIfExists('FormM');
    }
}
