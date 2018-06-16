<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaresAlreadyLoadedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('wares_already_loadeds'))
        {
            Schema::create('wares_already_loadeds', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('ID_truck')->unsigned();
                $table->integer('ID_trailer')->unsigned();
                $table->integer('ID_disposition')->unsigned();
                $table->timestamps();

                $table->foreign('ID_truck')->references('id')->on('trucks');
                $table->foreign('ID_trailer')->references('id')->on('trailers');
                $table->foreign('ID_disposition')->references('id')->on('loading_instructions');
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
        Schema::dropIfExists('wares_already_loadeds');
    }
}
