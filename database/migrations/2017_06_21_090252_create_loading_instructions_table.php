<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadingInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('loading_instructions'))
        {
            Schema::create('loading_instructions', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date');
                $table->float('amount', 8, 2);
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
        Schema::dropIfExists('loading_instructions');
    }
}
