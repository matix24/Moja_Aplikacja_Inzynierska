<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      if (!Schema::hasTable('user_roles'))
      {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
      }

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->integer('ID_roles')->unsigned();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('phone_number')->unsigned();
            $table->text('address');
            $table->boolean('archive');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('ID_roles')->references('id')->on('user_roles');
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
        Schema::dropIfExists('user_roles');
    }
}
