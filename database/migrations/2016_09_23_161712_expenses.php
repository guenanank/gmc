<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Expenses extends Migration {

    public function up() {
        Schema::dropIfExists('expenses');
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('expenseId');
            $table->decimal('expenseMin', 15, 2);
            $table->decimal('expenseMax', 15, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('expenses');
    }

}
