<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDzjlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_dzjl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('对账日期')->nullable();
            $table->string('对账人');
            $table->integer('对账结果');
            $table->integer('状态')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_dzjl');
    }
}
