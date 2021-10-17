<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->string('position');
            $table->integer('yearly_balance');
            $table->string('leave_type');
            $table->date('leave_date');
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
        Schema::dropIfExists('paid_leaves');
    }
}
