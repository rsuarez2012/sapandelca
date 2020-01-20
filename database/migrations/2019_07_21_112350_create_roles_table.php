<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->boolean('condition')->default(1);
            $table->timestamps();
        });
        DB::table('roles')->insert(array('id' => '1', 'name' => 'Administrador'));
        DB::table('roles')->insert(array('id' => '2', 'name' => 'Supervisor'));
        DB::table('roles')->insert(array('id' => '3', 'name' => 'Vendedor'));
        DB::table('roles')->insert(array('id' => '4', 'name' => 'Usuario'));



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
