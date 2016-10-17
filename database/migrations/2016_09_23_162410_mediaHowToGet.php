<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaHowToGet extends Migration {

    public function up() {
        Schema::dropIfExists('mediaHowToGet');
        Schema::create('mediaHowToGet', function (Blueprint $table) {
            $table->increments('mediaHowToGetId');
            $table->string('mediaHowToGetName', 127);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('mediaHowToGet');
    }

}
