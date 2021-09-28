<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerDistributeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('power_distribute_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('RESTRICT');
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
            $table->unsignedBigInteger('power_distribute_id');
            $table->foreign('power_distribute_id')
            ->references('id')
            ->on('power_distributes')
            ->onDelete('RESTRICT');
            $table->date('dated')->comment('收益日期');
            $table->unsignedInteger('power')->comment('算力');
            $table->decimal('all', 18, 8)->comment('全部收益');
            $table->decimal('lock', 18, 8)->comment('锁仓收益');
            $table->decimal('unlock', 18, 8)->comment('释放收益');
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
        Schema::dropIfExists('power_distribute_logs');
    }
}
