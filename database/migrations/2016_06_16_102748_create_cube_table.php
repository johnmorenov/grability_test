<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cube', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('x1')->unsigned();
            $table->integer('y1')->unsigned();
            $table->integer('z1')->unsigned();
            $table->bigInteger('W');
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
        Schema::drop('cube');
    }
}
