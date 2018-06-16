<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoxPalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_pallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ID_wares_already_loaded')->unsigned();
            $table->string('number_boxes');
            $table->timestamps();

            $table->foreign('ID_wares_already_loaded')->references('id')->on('wares_already_loadeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('box_pallets');
    }
}
