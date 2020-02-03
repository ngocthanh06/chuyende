<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Company', function (Blueprint $table) {
            $table->Increments('idComp');
            $table->string('nameComp')->nullable();
            $table->string('AddComp')->nullable();
            $table->string('faxComp')->nullable();
            $table->string('phoneComp')->nullable();
            $table->string('emailComp')->nullable();
            $table->integer('countComp')->nullable();
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
        Schema::dropIfExists('Company');
    }
}
