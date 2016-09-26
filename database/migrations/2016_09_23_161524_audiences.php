<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Audiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('audiences');
    }
}
