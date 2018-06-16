<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('trailers'))
        {
            Schema::create('trailers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('trailer_id_number');
                $table->integer('capacity')->unsigned();
                $table->integer('capacity_palete')->unsigned();
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
        Schema::dropIfExists('trailers');
    }
}
