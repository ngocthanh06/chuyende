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
        Schema::create('companies', function (Blueprint $table) {
            $table->Increments('idComp');
            $table->string('nameComp')->nullable();
            $table->string('add_comp')->nullable();
            $table->string('fax_comp')->nullable();
            $table->string('phone_comp')->nullable();
            $table->string('email_comp')->nullable();
            $table->integer('count_comp')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
