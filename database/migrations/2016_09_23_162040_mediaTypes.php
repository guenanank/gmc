<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaTypes extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('mediaTypes');
        Schema::create('mediaTypes', function (Blueprint $table) {
            $table->increments('mediaTypeId');
            $table->string('mediaTypeName', 127);
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('mediaTypes');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
