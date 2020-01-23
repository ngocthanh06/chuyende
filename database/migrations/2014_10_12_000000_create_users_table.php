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
            $table->Increments('User_id');
            $table->integer('Role_id')->nullable();
            $table->string('User_fullname')->nullable();
            $table->string('Username')->nullable();
            $table->dateTime('Birthday')->nullable();
            $table->boolean('sex')->nullable();
            $table->string('Password')->nullable();
            $table->string('User_image')->nullable();
            $table->string('User_add')->nullable();
            $table->string('User_phone')->nullable();
            $table->string('User_bank')->nullable();
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
