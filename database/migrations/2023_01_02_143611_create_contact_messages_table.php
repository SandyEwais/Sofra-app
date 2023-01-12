<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactMessagesTable extends Migration {

	public function up()
	{
		Schema::create('contact_messages', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->longText('message');
			$table->enum('type', array('suggestion', 'query', 'complaint'));
		});
	}

	public function down()
	{
		Schema::drop('contact_messages');
	}
}