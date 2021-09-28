<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
            ->references('id')
            ->on('admin_users')
            ->onDelete('cascade');
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')
            ->references('id')
            ->on('agents')
            ->onDelete('cascade');
            $table->unsignedInteger('users_count')->default(0)->comment('新增用户');
            $table->unsignedInteger('orders_count')->default(0)->comment('订单数');
            $table->decimal('amount',18,8)->default(0)->comment('销售业绩');
            $table->string('payment_type')->comment('支付方式')->default('USDT');
            $table->date('dated')->comment('统计日期');

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
        Schema::dropIfExists('agent_statistics');
    }
}
