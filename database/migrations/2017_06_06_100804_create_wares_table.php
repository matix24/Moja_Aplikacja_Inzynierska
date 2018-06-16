<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // if (!Schema::hasTable('hardiness_products'))
      // {
      //     Schema::create('hardiness_products', function (Blueprint $table) {
      //         $table->integer('id');
      //         $table->string('name');
      //         $table->timestamps();
      //
      //         $table->primary('id');
      //     });
      // }

      // if (!Schema::hasTable('quality_products'))
      // {
      //     Schema::create('quality_products', function (Blueprint $table) {
      //         $table->integer('id');
      //         $table->string('name');
      //         $table->timestamps();
      //
      //         $table->primary('id');
      //     });
      // }

      if (!Schema::hasTable('packaging_products'))
      {
          Schema::create('packaging_products', function (Blueprint $table) {
              $table->increments('id');
              $table->string('name');
              $table->timestamps();
          });
      }

      if (!Schema::hasTable('wares'))
      {
          Schema::create('wares', function (Blueprint $table) {
              $table->increments('id');
              // $table->integer('ID_hardiness')->unsigned();
              // $table->integer('ID_quality')->unsigned();
              $table->integer('ID_packaging')->unsigned();
              $table->string('name');
              $table->float('weight_of_package');
              $table->boolean('archive');
              $table->timestamps();

              // $table->foreign('ID_hardiness')->references('id')->on('hardiness_products');
              // $table->foreign('ID_quality')->references('id')->on('quality_products');
              $table->foreign('ID_packaging')->references('id')->on('packaging_products');
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
        Schema::dropIfExists('wares');
    }
}
