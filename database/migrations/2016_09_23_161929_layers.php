<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Layers extends Migration {

    public function up() {
        Schema::dropIfExists('layers');
        Schema::create('layers', function (Blueprint $table) {
            $table->increments('layerId');
            $table->string('layerName', 127);
            $table->text('layerDesc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('layers');
    }

}
