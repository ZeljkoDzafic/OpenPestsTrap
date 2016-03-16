<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->string('name');
            $table->integer('pests_network_id');
            $table->integer('user_id');
            $table->double('latitude',15,8);
            $table->double('longitude',15,8);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->tinyInteger('status');
            $table->text('description');
            $table->tinyInteger('is_public');
            $table->integer('plate_counter');
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
        Schema::drop('traps');
    }
}
