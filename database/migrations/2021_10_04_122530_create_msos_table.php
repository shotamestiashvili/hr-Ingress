<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msos', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('position');
            $table->string('type');
            $table->string('mso_position');
            $table->date(  'startdate');
            $table->string('starttime');
            $table->date(  'enddate');
            $table->string('endtime');
            $table->string('total_hours');
            $table->string('breaktime');
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
        Schema::dropIfExists('msos');
    }
}
