<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyMarketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_market_biki', function (Blueprint $table) {
            $table->string('symbol')->comment('交易对');
            $table->string('vol')->nullable()->comment('24小时交易量');
            $table->string('high')->nullable()->comment('最近24H 最高价');
            $table->string('last')->nullable()->comment('最新价');
            $table->string('low')->nullable()->comment('当日 最低价');
            $table->string('buy')->nullable()->comment('当前买一价');
            $table->string('sell')->nullable()->comment('当前卖一价');
            $table->string('change')->nullable()->comment('当日 价格变化');
            $table->string('rose')->nullable()->comment('当日 涨跌幅度');
            $table->string('amount')->nullable()->comment('金额数量');
            $table->string('type');
            $table->string('isShow');
            $table->string('newCoinFlag');
            $table->string('showName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_market');
    }
}
