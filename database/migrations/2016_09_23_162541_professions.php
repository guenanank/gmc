<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Professions extends Migration {

    public function up() {
        Schema::dropIfExists('professions');
        Schema::create('professions', function (Blueprint $table) {
            $table->increments('professionId');
            $table->string('professionName', 127);
            $table->integer('professionSubFrom')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('professions');
    }

}
