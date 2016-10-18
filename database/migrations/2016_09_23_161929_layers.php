<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Layers extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('layers');
        Schema::create('layers', function (Blueprint $table) {
            $table->increments('layerId');
            $table->string('layerName', 127);
            $table->text('layerDesc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('layers');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
