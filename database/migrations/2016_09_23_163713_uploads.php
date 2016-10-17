<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Uploads extends Migration {

    public function up() {
        Schema::dropIfExists('uploads');
        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('uploadId');
            $table->string('uploadFilename', 127);
            $table->boolean('uploadIsExecuted');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('uploads');
    }

}
