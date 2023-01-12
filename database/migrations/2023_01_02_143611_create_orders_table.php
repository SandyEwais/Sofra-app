<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('total_order_price')->default(0);
			$table->decimal('meals_cost')->default(0);
			$table->enum('state', array('pending', 'accepted', 'rejected', 'delivered', 'declined'))->default('pending');
			$table->longText('notes');
			$table->string('delivery_address');
			$table->enum('payment_method', array('online', 'cash'));
			$table->decimal('delivery_fees')->default(0);
			$table->integer('client_id')->unsigned();
			$table->decimal('app_commission')->default(0);
			$table->decimal('restaurant_net')->default(0);
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}