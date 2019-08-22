<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTradeToTableSfjlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_sfjl', function (Blueprint $table) {
            $table->string('trade_no')->nullable()->unique()->after('sfdh')->charset('gb2312')->collation('gb2312_chinese_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_sfjl', function (Blueprint $table) {
            $table->dropColumn('trade_no');
        });
    }
}
