<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHardinessProductsTable extends Migration
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
      //         $table->integer('id')->unsigned()->unique();
      //         $table->string('name');
      //         $table->timestamps();
      //
      //         $table->primary('id');
      //     });
      // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wares');
        Schema::dropIfExists('hardiness_products');
    }
}
