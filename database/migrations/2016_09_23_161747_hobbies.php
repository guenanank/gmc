<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hobbies extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('hobbies');
        Schema::create('hobbies', function (Blueprint $table) {
            $table->increments('hobbyId');
            $table->string('hobbyName', 127);
            $table->integer('hobbySubFrom');
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('hobbies');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
