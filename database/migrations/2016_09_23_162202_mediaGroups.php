<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaGroups extends Migration {

    public function up() {
        Schema::dropIfExists('mediaGroups');
        Schema::create('mediaGroups', function (Blueprint $table) {
            $table->increments('mediaGroupId');
            $table->string('mediaGroupName', 127);
            $table->string('mediaGroupMap', 15)->nullable();
            $table->integer('mediaGroupSubFrom')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('mediaGroups');
    }

}
