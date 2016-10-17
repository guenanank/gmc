<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hobbies extends Migration {

    public function up() {
        Schema::dropIfExists('hobbies');
        Schema::create('hobbies', function (Blueprint $table) {
            $table->increments('hobbyId');
            $table->string('hobbyName', 127);
            $table->integer('hobbySubFrom');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('hobbies');
    }

}
