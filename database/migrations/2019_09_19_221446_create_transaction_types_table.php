<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_type');
            $table->timestamps();
        });

        DB::table('transaction_types')->insert([
            'transaction_type' => 'Top Up'
        ]);
          DB::table('transaction_types')->insert([
            'transaction_type' => 'Withdraw'
        ]);
        DB::table('transaction_types')->insert([
         'transaction_type' => 'Pay Out'
     ]);
           DB::table('transaction_types')->insert([
            'transaction_type' => 'Subscription'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_types');
    }
}
