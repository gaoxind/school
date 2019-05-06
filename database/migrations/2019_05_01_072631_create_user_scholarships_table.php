<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_scholarships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->integer('user_id');
            $table->integer('scholarship_id');
            $table->integer('required_course');
            $table->integer('optional_course');
            $table->integer('status');
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
        Schema::dropIfExists('user_scholarships');
    }
}
