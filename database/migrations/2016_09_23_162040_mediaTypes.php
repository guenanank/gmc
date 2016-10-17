<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaTypes extends Migration {

    public function up() {
        Schema::dropIfExists('mediaTypes');
        Schema::create('mediaTypes', function (Blueprint $table) {
            $table->increments('mediaTypeId');
            $table->string('mediaTypeName', 127);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('mediaTypes');
    }

}
