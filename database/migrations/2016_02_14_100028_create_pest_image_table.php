<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePestImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pest_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pest_image');
            $table->string('name_of_pest');
            $table->integer('x');
            $table->integer('y');
            $table->integer('height');
            $table->integer('width');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pest_image');
    }
}
