<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Customer_Id')->unsigned();
            $table->foreign('Customer_Id')->references('id')->on('Customers');
            $table->integer('Kamar_Id')->unsigned();
            $table->foreign('Kamar_Id')->references('id')->on('Rooms');
            $table->Date('Check_In');
            $table->Date('Check_Out');

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
        Schema::dropIfExists('transaksis');
    }
}
