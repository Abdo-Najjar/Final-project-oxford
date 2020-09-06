<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->integer('topicFamiliariy');
            $table->integer('communicateInfo');
            $table->integer('presentationMethod');
            $table->integer('explainContent');
            $table->integer('cooperation');
            $table->integer('varietyOfMethod');
            $table->integer('abilityOfMotivation');
            $table->integer('abilityOfDiscussion');
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
        Schema::dropIfExists('teacher_evaluations');
    }
}
