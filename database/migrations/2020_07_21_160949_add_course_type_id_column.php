<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseTypeIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('course_type_id')->index()->nullable();
            $table->foreign('course_type_id')->references('id')->on('course_types');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreignId('course_type_id')->index()->nullable();
            $table->foreign('course_type_id')->references('id')->on('course_types');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->foreignId('course_type_id')->index()->nullable();
            $table->foreign('course_type_id')->references('id')->on('course_types');
        });

        Schema::table('user_infos' , function(Blueprint $table){
            $table->foreignId('course_type_id')->index()->nullable();
            $table->foreign('course_type_id')->references('id')->on('course_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign('course_type_id');
            $table->dropColumn('course_type_id');   
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign('course_type_id');
            $table->dropColumn('course_type_id');   
        });

        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropForeign('course_type_id');
            $table->dropColumn('course_type_id');   
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('course_type_id');
            $table->dropColumn('course_type_id');   
        });
    }
}
