<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('user_id');
            $table->integer('role_id')->nullable();
            $table->string('user_fullname')->nullable();
            $table->string('username')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('user_image')->nullable();
            $table->string('user_add')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_bank')->nullable();
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->integer('socical_insurance')->nullable();	
            $table->boolean('active')->nullable()->default(1);
            $table->integer('idComp')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
