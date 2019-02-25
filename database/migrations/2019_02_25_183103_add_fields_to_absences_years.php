<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAbsencesYears extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absences_years', function (Blueprint $table) {
            $table->integer('official_leave_hours_remaining');
            $table->integer('official_leave_hours_scheduled');
            $table->integer('extra_leave_hours_remaining');
            $table->integer('extra_leave_hours_scheduled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absences_years', function (Blueprint $table) {
            $table->dropColumn('official_leave_hours_remaining');
            $table->dropColumn('official_leave_hours_scheduled');
            $table->dropColumn('extra_leave_hours_remaining');
            $table->dropColumn('extra_leave_hours_scheduled');
        });
    }
}
