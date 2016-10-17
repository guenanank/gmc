<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Interests extends Migration {

    public function up() {
        Schema::dropIfExists('interests');
        Schema::create('interests', function (Blueprint $table) {
            $table->increments('interestId');
            $table->string('interestName', 127);
            $table->integer('interestSubFrom');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('interests');
    }

}
