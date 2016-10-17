<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AudienceActivity extends Migration {

    public function up() {
        Schema::dropIfExists('audienceActivity');
        Schema::create('audienceActivity', function (Blueprint $table) {
            $table->bigInteger('audienceId')->unsigned()->index();
            $table->integer('activityId')->unsigned()->index();

            $table->foreign('audienceId')->references('audienceId')->on('audiences')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('activityId')->references('activityId')->on('activities')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down() {
        Schema::drop('audienceActivity');
    }

}
