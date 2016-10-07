<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MediaHowToGet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mediaHowToGet');
        Schema::create('mediaHowToGet', function (Blueprint $table) {
            $table->increments('mediaHowToGetId');
            $table->string('mediaHowToGetName', 127);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mediaHowToGet');
    }
}
