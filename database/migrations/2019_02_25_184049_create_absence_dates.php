<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenceDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absence_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('absence_id')->unsigned()->index()->nullable();
            $table->foreign('absence_id')->references('id')->on('absences');
            $table->date('date');
            $table->integer('number_of_hours');
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
        Schema::dropIfExists('absence_dates');
    }
}
