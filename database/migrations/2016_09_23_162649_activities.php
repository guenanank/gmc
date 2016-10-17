<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Activities extends Migration {

    public function up() {
        Schema::dropIfExists('activities');
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('activityId');
            $table->integer('sourceId')->unsigned()->index();
            $table->integer('mediaGroupId')->unsigned()->index();
            $table->string('activityName', 127);
            $table->string('activityWhere', 63)->nullable();
            $table->date('activityWhen')->nullable();
            $table->string('activityToken', 15);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sourceId')->references('sourceId')->on('sources')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mediaGroupId')->references('mediaGroupId')->on('mediaGroups')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down() {
        Schema::drop('activities');
    }

}
