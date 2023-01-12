<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealsTable extends Migration {

	public function up()
	{
		Schema::create('meals', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->mediumText('description');
			$table->decimal('price');
			$table->string('time');
			$table->integer('restaurant_id')->unsigned();
			$table->string('image');
			$table->decimal('price_sale');
			$table->integer('category_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}