<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('organization_id');
			$table->string('fname');
			$table->string('lname');
			$table->string('title')->nullable();
			$table->string('work_phone')->nullable();
			$table->string('mobile_phone')->nullable();
			$table->string('email_1')->nullable();
			$table->string('email_2')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
