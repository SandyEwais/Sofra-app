<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->boolean('activation')->default(1);
			$table->string('image');
			$table->tinyInteger('star_rate');
			$table->decimal('minimum_charge');
			$table->decimal('delivery_fees');
			$table->enum('state', array('open', 'closed'));
			$table->string('contact_phone');
			$table->string('whatsapp');
			$table->timestamps();
			$table->integer('neighborhood_id')->unsigned();
			$table->string('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}