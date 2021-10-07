<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('worktype');
            $table->date('startdate');
            $table->string('starttime');
            $table->string('intime')->nullable();
            $table->date('enddate');
            $table->string('endtime');
            $table->string('outtime')->nullable();
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
        Schema::dropIfExists('active_schedules');
    }
}
