<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaresInTheBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wares_in_the_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ID_boxpallet')->unsigned();
            $table->integer('ID_ware')->unsigned();
            $table->integer('ID_seller')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->float('amount', 8, 2);
            $table->timestamps();

            $table->foreign('ID_boxpallet')->references('id')->on('box_pallets');
            $table->foreign('ID_ware')->references('id')->on('wares');
            $table->foreign('ID_seller')->references('id')->on('sellers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wares_in_the_boxes');
    }
}
