<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Interests extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('interests');
        Schema::create('interests', function (Blueprint $table) {
            $table->increments('interestId');
            $table->string('interestName', 127);
            $table->integer('interestSubFrom');
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('interests');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
