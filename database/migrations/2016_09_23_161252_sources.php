<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sources extends Migration {

    public function up() {
        Schema::dropIfExists('sources');
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('sourceId');
            $table->string('sourceName', 127);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('sources');
    }

}
