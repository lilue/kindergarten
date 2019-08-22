<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableXsxxTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_xsxx', function(Blueprint $table)
		{
			$table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
			$table->bigIncrements('id', true);
			$table->string('xsbh', 50);
			$table->string('xsxm', 50);
			$table->string('bj', 50);
			$table->string('sjhm', 11);
			$table->string('openid', 100)->nullable();;
			$table->integer('zt')->default(1)->comment('1正常，0删除');
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
		Schema::drop('table_xsxx');
	}

}
