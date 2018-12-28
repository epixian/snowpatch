<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeJobsitesTableAddType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobsites', function (Blueprint $table) {
            $table->unsignedTinyInteger('type')->nullable()->default(0);
			$table->unsignedTinyInteger('status')->nullable()->default(0);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobsites', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('status');
        });
    }
}
