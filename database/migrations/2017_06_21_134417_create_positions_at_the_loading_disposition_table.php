<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsAtTheLoadingDispositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('position_at_the_loading_dispositions'))
        {
            Schema::create('position_at_the_loading_dispositions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('ID_wares')->unsigned();
                $table->integer('ID_sellers')->unsigned();
                $table->integer('weight_per_package')->unsigned();
                $table->float('amount', 8, 2);
                $table->boolean('priority');
                $table->timestamps();

                $table->foreign('ID_wares')->references('id')->on('wares');
                $table->foreign('ID_sellers')->references('id')->on('sellers');
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
        Schema::dropIfExists('relationship_relations_with_lists');
        Schema::dropIfExists('position_at_the_loading_dispositions');
    }
}
