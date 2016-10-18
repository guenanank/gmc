<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Audiences extends Migration {

    public function up() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('audiences');
        Schema::create('audiences', function (Blueprint $table) {
            $table->bigIncrements('audienceId');
            $table->string('audienceType', 15);
            $table->integer('clubId')->nullable();
            $table->integer('memberId')->nullable();
            $table->integer('customerId')->nullable();
            $table->timestamps();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('audiences');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
