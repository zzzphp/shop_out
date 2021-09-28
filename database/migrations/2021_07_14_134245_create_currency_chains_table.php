<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyChainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_chains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('RESTRICT');
            $table->string('name')->comment('链名');
            $table->string('min_amount')->comment('最小数量');
            $table->string('service_charge')->comment('手续费');
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
        Schema::dropIfExists('currency_chains');
    }
}
