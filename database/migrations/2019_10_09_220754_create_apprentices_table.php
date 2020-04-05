<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprenticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprentices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('initialName');
            $table->string('mailingAddress');
            $table->string('city');
            $table->string('zip');
            $table->bigInteger('phone');
            $table->string('email');
            $table->string('studentId');
            $table->string('highSchool')->nullable();
            $table->string('highSchoolCity')->nullable();
            $table->string('highSchoolYear')->nullable();
            $table->string('institue1')->nullable();
            $table->string('instituteCity1')->nullable();
            $table->string('instituteDate1')->nullable();
            $table->string('certificate1')->nullable();
            $table->string('institute2')->nullable();
            $table->string('instituteCity2')->nullable();
            $table->string('instituteDate2')->nullable();
            $table->string('certificate2')->nullable();
            $table->text('experience');
            $table->text('objective');            
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
        Schema::dropIfExists('apprentices');
    }
}
