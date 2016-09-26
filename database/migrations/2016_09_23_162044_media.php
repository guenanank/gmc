<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Media extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('media');
        Schema::create('media', function (Blueprint $table) {
            $table->increments('mediaId');
            $table->string('mediaName', 127);
            $table->integer('mediaTypeId')->unsigned()->index()->nullable();
            $table->timestamps();
            
            $table->foreign('mediaTypeId')->references('mediaTypeId')->on('mediaTypes')->onDelete('cascade')->onUpdate('cascade');
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('media');
    }
}
