<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Professions extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('professions');
        Schema::create('professions', function (Blueprint $table) {
            $table->increments('professionId');
            $table->string('professionName', 127);
            $table->integer('professionSubFrom')->nullable();
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('professions');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
