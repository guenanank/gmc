<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AudienceLayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('audienceLayer');
        Schema::create('audienceLayer', function (Blueprint $table) {
            $table->bigInteger('audienceId')->unsigned()->index();
            $table->integer('layerId')->unsigned()->index();
            $table->text('audienceLayerResponse');
            
            $table->foreign('audienceId')->references('audienceId')->on('audiences')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('layerId')->references('layerId')->on('layers')->onDelete('cascade')->onUpdate('cascade');
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('audienceLayer');
    }
}
