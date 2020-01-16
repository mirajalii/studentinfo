<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentsInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Students_Info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('roll_no');
            $table->string('name');
            $table->string('class');
            $table->string('age');
            $table->string('gender');
            $table->string('hobies');
            $table->string('image');
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
        //
    }
}
