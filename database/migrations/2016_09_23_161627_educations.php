<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Educations extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('education');
        Schema::create('education', function (Blueprint $table) {
            $table->increments('educationId');
            $table->string('educationName', 127);
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('education');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
