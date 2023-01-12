<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealOrderTable extends Migration {

	public function up()
	{
		Schema::create('meal_order', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('meal_id')->unsigned();
			$table->integer('order_id')->unsigned();
			$table->longText('notes');
			$table->integer('quantity');
			$table->decimal('meal_price');
		});
	}

	public function down()
	{
		Schema::drop('meal_order');
	}
}