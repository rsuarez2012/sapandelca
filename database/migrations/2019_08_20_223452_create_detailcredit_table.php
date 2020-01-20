<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailcreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('detailcredit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credit_id')->unsigned();
            $table->foreign('credit_id')->references('id')->on('credit');
            $table->integer('total')->nullable();
            $table->enum('payment_type', array('1','2','3','4','5','6','7'))->nullable();
            $table->string('bank')->nullable();
            $table->string('reference')->nullable();
            $table->string('rode')->nullable();
            $table->string('subtraction')->nullable();
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
