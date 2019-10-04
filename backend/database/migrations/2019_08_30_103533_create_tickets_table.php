<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
			$table->increments('id');
			$table->uuid('code');
			$table->string('film');
            $table->date('date');
            $table->time('start_time')->nullable();
            $table->time('finish_time')->nullable();
            $table->integer('quantity')->nullable();
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
		Schema::dropIfExists('tickets');
    }
}
