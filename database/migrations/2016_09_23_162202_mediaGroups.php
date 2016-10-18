<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaGroups extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('mediaGroups');
        Schema::create('mediaGroups', function (Blueprint $table) {
            $table->increments('mediaGroupId');
            $table->string('mediaGroupName', 127);
            $table->string('mediaGroupMap', 15)->nullable();
            $table->integer('mediaGroupSubFrom')->nullable();
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('mediaGroups');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
