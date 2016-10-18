<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AudienceActivity extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('audienceActivity');
        Schema::create('audienceActivity', function (Blueprint $table) {
            $table->bigInteger('audienceId')->unsigned()->index();
            $table->integer('activityId')->unsigned()->index();

            $table->foreign('audienceId')->references('audienceId')->on('audiences')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('activityId')->references('activityId')->on('activities')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('audienceActivity');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
