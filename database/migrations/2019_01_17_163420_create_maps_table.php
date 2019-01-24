<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jobsite_id');
            $table->string('name')->nullable();
            $table->string('status')->default('draft');
            $table->point('map_center')->nullable();
            $table->unsignedTinyInteger('map_zoom')->default(18);
            $table->string('map_type')->default('satellite');
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
        Schema::dropIfExists('maps');
    }
}
