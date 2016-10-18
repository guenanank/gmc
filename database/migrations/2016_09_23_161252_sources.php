<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sources extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('sources');
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('sourceId');
            $table->string('sourceName', 127);
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('sources');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
