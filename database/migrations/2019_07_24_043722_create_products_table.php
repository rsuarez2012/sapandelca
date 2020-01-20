<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod',50)->nullable()->unique();
            $table->string('product',100)->unique();
            $table->enum('presentation', array('1', '2'));
            $table->integer('package')->nullable();
            $table->decimal('buy',11,2);
            $table->enum('exent_iva', array('0', '1'));
            $table->integer('stock');
            $table->boolean('condition')->default(1);
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
        Schema::dropIfExists('products');
    }
}
