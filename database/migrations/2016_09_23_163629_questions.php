<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questions extends Migration {

    public function up() {
        Schema::dropIfExists('questions');
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('questionId');
            $table->integer('layerId')->unsigned()->index();
            $table->integer('masterId')->unsigned()->nullable()->index();
            $table->string('questionType', 31);
            $table->string('questionText', 255);
            $table->text('questionAnswer')->nullable();
            $table->text('questionDesc')->nullable();
            $table->string('question', 31)->nullable();
            $table->boolean('questionIsMandatory');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('masterId')->references('masterId')->on('masters')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('layerId')->references('layerId')->on('layers')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down() {
        Schema::drop('questions');
    }

}
