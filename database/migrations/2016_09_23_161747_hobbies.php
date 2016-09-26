<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hobbies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('hobbies');
        Schema::create('hobbies', function (Blueprint $table) {
            $table->increments('hobbyId');
            $table->string('hobbyName', 127);
            $table->integer('hobbySubFrom');
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
        Schema::drop('hobbies');
    }
}
