<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inouts', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->date('date');
            $table->string('att_in')->nullable();
            $table->string('att_break')->nullable();
            $table->string('att_resume')->nullable();
            $table->string('att_out')->nullable();
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
        Schema::dropIfExists('inouts');
    }
}
