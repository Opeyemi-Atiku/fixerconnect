<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicianTradeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technician_trade_lists', function (Blueprint $table) {
          $table->increments('id');
          $table->string('trade_name');
          $table->timestamps();
      });
      DB::table('technician_trade_lists')->insert([
          'trade_name' => 'HVCA'
      ]);
        DB::table('technician_trade_lists')->insert([
          'trade_name' => 'Electrical'
      ]);
      DB::table('technician_trade_lists')->insert([
       'trade_name' => 'Plumbing'
     ]);
     DB::table('technician_trade_lists')->insert([
      'trade_name' => 'Handy Pro'
    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technician_trade_lists');
    }
}
