<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email');
			$table->string('password');
			$table->boolean('activation')->default(1);
			$table->string('phone');
			$table->string('pin_code')->nullable();
			$table->integer('neighborhood_id')->unsigned();
			$table->string('name');
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}