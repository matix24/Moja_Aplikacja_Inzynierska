<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagingProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('packaging_products'))
      {
          Schema::create('packaging_products', function (Blueprint $table) {
              $table->increments('id');
              $table->string('name');
              $table->boolean('archive');
              $table->timestamps();
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
        Schema::dropIfExists('packaging_products');
    }
}
