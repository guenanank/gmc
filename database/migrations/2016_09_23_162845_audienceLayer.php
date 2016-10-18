<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AudienceLayer extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('audienceLayer');
        Schema::create('audienceLayer', function (Blueprint $table) {
            $table->bigInteger('audienceId')->unsigned()->index();
            $table->integer('layerId')->unsigned()->index();
            $table->text('audienceLayerResponse');

            $table->foreign('audienceId')->references('audienceId')->on('audiences')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('layerId')->references('layerId')->on('layers')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('audienceLayer');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
