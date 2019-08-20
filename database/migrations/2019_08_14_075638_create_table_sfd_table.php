<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableSfdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_sfd', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('sfdh', 20);
			$table->dateTime('cjsj');
			$table->string('cjr', 20);
			$table->integer('zt')->default(1)->comment('-1删除,0禁用,1启用');
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
		Schema::drop('table_sfd');
	}

}
