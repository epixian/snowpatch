<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapfeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_features', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('map_id');
            $table->geometry('geometry');
            $table->string('description');               // what the geometry object(s) are used to denote
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
        Schema::dropIfExists('mapfeatures');
    }
}
