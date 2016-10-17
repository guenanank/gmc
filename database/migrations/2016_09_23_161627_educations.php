<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Educations extends Migration {

    public function up() {
        Schema::dropIfExists('education');
        Schema::create('education', function (Blueprint $table) {
            $table->increments('educationId');
            $table->string('educationName', 127);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('education');
    }

}
