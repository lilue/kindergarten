<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableSfdmxTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_sfdmx', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('sfdh', 20);
			$table->string('xsbh', 50);
			$table->string('sfxm', 50);
			$table->decimal('fyje', 10);
			$table->integer('zt')->default(1)->comment('1正常,0删除,2已缴费');
			$table->dateTime('scrq')->nullable();
			$table->string('scr', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('table_sfdmx');
	}

}
