<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerDistributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_distributes', function (Blueprint $table) {
            $table->id();
            $table->string('hash_key')->unique();
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')
            ->references('id')
            ->on('currencies')
            ->onDelete('RESTRICT');
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')
            ->references('id')
            ->on('stages')
            ->onDelete('RESTRICT');
            $table->date('dated')->comment('收益日期');
            $table->decimal('available_assets',18,8)->comment('每T收益');
            $table->decimal('mortgage_advance',18,8)->comment('每T垫付抵押');
            $table->decimal('mortgage_user',18,8)->comment('用户每T垫付抵押');
            $table->unsignedInteger('num')->default(0)->comment('释放次数');
            $table->date('last_dated')->nullable()->comment('释放日期');
            $table->string('status')->comment('当前状态');
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
        Schema::dropIfExists('power_distributes');
    }
}
