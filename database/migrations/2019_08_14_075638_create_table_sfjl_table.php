<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableSfjlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_sfjl', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('sfdh', 20);
			$table->string('xsbh', 50);
			$table->decimal('sfje', 10);
			$table->dateTime('sfsj');
			$table->string('sfry', 20);
			$table->string('sffs', 20);
			$table->integer('ZT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('table_sfjl');
	}

}
