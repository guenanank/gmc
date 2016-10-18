<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaHowToGet extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('mediaHowToGet');
        Schema::create('mediaHowToGet', function (Blueprint $table) {
            $table->increments('mediaHowToGetId');
            $table->string('mediaHowToGetName', 127);
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('mediaHowToGet');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
