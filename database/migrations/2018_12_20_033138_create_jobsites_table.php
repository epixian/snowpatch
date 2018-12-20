<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('jobsites', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('organization_id');
			$table->string('name');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->string('postal_code');
			$table->string('country');
			$table->text('notes')->nullable();
			$table->decimal('acreage')->nullable();
			$table->unsignedInteger('linear_feet')->nullable();
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
        Schema::dropIfExists('jobsites');
    }
}
