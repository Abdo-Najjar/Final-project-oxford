<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->foreignId('section_id')->index()->constrained();
            $table->integer('speaking');
            $table->integer('converstion'); 
            $table->integer('reading');
            $table->integer('writing');
            $table->integer('vocab');
            $table->integer('english_speaking');
            $table->integer('commitment_time');
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
        Schema::dropIfExists('section_evaluations');
    }
}
