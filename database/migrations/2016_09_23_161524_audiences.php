<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Audiences extends Migration {

    public function up() {
        Schema::dropIfExists('audiences');
        Schema::create('audiences', function (Blueprint $table) {
            $table->bigIncrements('audienceId');
            $table->string('audienceType', 15);
            $table->integer('clubId')->nullable();
            $table->integer('memberId')->nullable();
            $table->integer('customerId')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('audiences');
    }

}
