<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipRelationsWithListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('relationship_relation_with_lists'))
        {
            Schema::create('relationship_relation_with_lists', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('ID_disposition')->unsigned();
                $table->integer('ID_position')->unsigned();
                $table->timestamps();

                $table->foreign('ID_disposition')->references('id')->on('loading_instructions');
                $table->foreign('ID_position')->references('id')->on('position_at_the_loading_dispositions');
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
        Schema::dropIfExists('relationship_relation_with_lists');
        Schema::dropIfExists('relationship_relations_with_lists');
        Schema::dropIfExists('position_at_the_loading_dispositions');
    }
}
