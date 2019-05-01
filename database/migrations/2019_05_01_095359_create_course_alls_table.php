<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAllsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_alls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('major');
            $table->integer('user_id');
            $table->integer('courseNameOne');
            $table->integer('courseOne');
            $table->integer('courseNameTwo');
            $table->integer('courseTwo');
            $table->integer('courseNameThree');
            $table->integer('courseThree');
            $table->integer('MoralCourse');
            $table->integer('addCourse');
            $table->integer('subCourse');
            $table->integer('break');
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
        Schema::dropIfExists('course_alls');
    }
}
