<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicianInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('location')->nullable();
            $table->string('gender')->nullable();
            $table->string('license')->nullable();
            $table->string('profile_image')->default('profile_image.png');
            $table->text('experience')->nullable();
            $table->string('currency')->nullable();
            $table->integer('charges')->nullable();
            $table->integer('trade_type')->nullable();
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
        Schema::dropIfExists('technician_infos');
    }
}
