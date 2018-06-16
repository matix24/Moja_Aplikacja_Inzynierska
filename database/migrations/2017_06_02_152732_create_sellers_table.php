<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sellers'))
        {
            Schema::create('sellers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('surname');
                $table->text('address');
                $table->integer('phone_number')->unsigned();
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
        Schema::dropIfExists('sellers');
    }
}
