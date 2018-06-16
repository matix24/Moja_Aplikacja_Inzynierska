<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersToLoadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_to_loads'))
        {
            Schema::create('user_to_loads', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('ID_employee')->unsigned();
                $table->integer('ID_wares_already_loaded')->unsigned();
                $table->timestamps();

                $table->foreign('ID_employee')->references('id')->on('users');
                $table->foreign('ID_wares_already_loaded')->references('id')->on('wares_already_loadeds');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_to_loads');
    }
}
