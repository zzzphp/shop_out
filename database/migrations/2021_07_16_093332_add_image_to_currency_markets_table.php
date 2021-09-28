<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToCurrencyMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currency_market_biki', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable()->comment('图标');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currency_market_biki', function (Blueprint $table) {
            //
            $table->dropColumn('image');
        });
    }
}
