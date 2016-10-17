<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Masters extends Migration {

    public function up() {
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
    }

    public function down() {
        Schema::drop('masters');
    }

}
