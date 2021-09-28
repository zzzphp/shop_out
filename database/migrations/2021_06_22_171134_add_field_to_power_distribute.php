<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToPowerDistribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('power_distributes', function (Blueprint $table) {
            //
            $table->tinyInteger('first')->comment('首次发放(%)')->default(100);
            $table->integer('line_day')->comment('天数')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('power_distribute_logs', function (Blueprint $table) {
            //
            $table->dropColumn('first');
            $table->dropColumn('line_day');
        });
    }
}
