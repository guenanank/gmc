<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Uploads extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('uploads');
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('uploadId');
            $table->string('uploadFilename', 127);
            $table->boolean('uploadIsExecuted');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('uploads');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
