<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questions extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('questions');
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('questionId');
            $table->integer('layerId')->unsigned()->index();
            $table->integer('masterId')->unsigned()->nullable()->index();
            $table->string('questionType', 31);
            $table->string('questionText', 255);
            $table->text('questionAnswer')->nullable();
            $table->text('questionDesc')->nullable();
            $table->string('questionFormType', 31)->nullable();
            $table->boolean('questionIsMandatory');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('masterId')->references('masterId')->on('masters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('layerId')->references('layerId')->on('layers')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('questions');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
