<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableYhxxTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_yhxx', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('yhdm', 10);
			$table->string('yhxm', 10);
			$table->string('yhmm', 30)->nullable()->default('');
			$table->string('yhqx', 10)->nullable();
			$table->integer('yhjs')->nullable();
			$table->integer('zt')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('table_yhxx');
	}

}
