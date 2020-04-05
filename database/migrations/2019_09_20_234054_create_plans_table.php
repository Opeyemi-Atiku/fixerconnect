<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->integer('days');
          $table->float('amount');
          $table->timestamps();
            /*$table->increments('id');
            $table->string('name');
            $table->integer('days');
            $table->float('amount');
            $table->timestamps();*/
        });

        /*DB::table('plans')->insert([
            'name' => 'Membership',
            'amount' => 10,
            'days' => 30,
        ]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
