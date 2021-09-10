<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('personal_id');
            $table->string('birth_day');
            $table->string('gender');
            $table->string('address');
            $table->string('retirement');
            $table->string('family_status');
            $table->string('education');
            $table->string('contact_info');
            $table->string('position');
            $table->string('department');
            $table->string('head');
            $table->string('companyid');
            $table->string('food');
            $table->string('subordinate_stuff')->nullable();
            $table->string('military_info')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('registration_date')->nullable()->default('Null');
            $table->string('author')->nullable();
            $table->string('food')->nullable();
            $table->string('ensuarence')->nullable();
            $table->string('additional')->nullable();
            $table->string('bank_account')->nullable()->default('Null');
            $table->string('companyid')->nullable();
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
        Schema::dropIfExists('personnels');
    }
}
