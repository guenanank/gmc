<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Media extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('media');
        Schema::create('media', function (Blueprint $table) {
            $table->increments('mediaId');
            $table->string('mediaName', 127);
            $table->integer('mediaTypeId')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->foreign('mediaTypeId')->references('mediaTypeId')->on('mediaTypes')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::enableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('media');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
