<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('content');
			$table->integer('order_id')->unsigned();
			$table->boolean('is_read')->default(0);
			$table->integer('notificatable_id');
			$table->string('notificatable_type');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}