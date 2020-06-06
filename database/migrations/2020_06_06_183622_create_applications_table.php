<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('address');
            $table->date('dob');
            $table->string('phone_number');
            $table->string('level');
            $table->string('days');
            $table->time('time');
            $table->string('major_of_study');
            $table->longText('recognize')->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('picture_permission');
            $table->bigInteger('national_number');
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
        Schema::dropIfExists('applications');
    }
}