<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Masters extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('masters');
        Schema::create('masters', function (Blueprint $table) {
            $table->increments('masterId');
            $table->string('masterName', 127);
            $table->boolean('masterUseAPI');
            $table->text('masterFormat')->nullable();
            $table->text('masterRawQuery')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('masters');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
