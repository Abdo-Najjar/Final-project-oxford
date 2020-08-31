<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mass_media', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('url');
            //0 for vedio , 1 for audio
            $table->enum('type' , ['0','1']);
            $table->foreignId('course_type_id')->index()->constrained();
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
        Schema::dropIfExists('mass_media');
    }
}
