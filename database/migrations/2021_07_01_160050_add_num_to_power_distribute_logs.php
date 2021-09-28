<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumToPowerDistributeLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('power_distribute_logs', function (Blueprint $table) {
            //
            $table->unsignedInteger('num')->default(0)->after('unlock')->comment('释放次数');
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
            $table->dropColumn('num');
        });
    }
}
