<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name');
            $table->timestamps();
        });
        DB::table('account_types')->insert([
            'account_name' => 'technician'
        ]);
          DB::table('account_types')->insert([
            'account_name' => 'residential'
        ]);
        DB::table('account_types')->insert([
         'account_name' => 'commercial'
     ]);
           DB::table('account_types')->insert([
            'account_name' => 'admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_types');
    }
}
