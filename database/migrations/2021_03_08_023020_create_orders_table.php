<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('no')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->unsignedInteger('amount')->comment('矿机数量');
            $table->decimal('total_amount', 10, 2)->default(0.00)->comment('订单总金额');
            $table->text('remark')->nullable()->comment('备注');
            $table->dateTime('paid_at')->nullable()->comment('支付时间');
            $table->string('paid_prove')->nullable()->comment('支付证明');
            $table->string('payment_method')->nullable()->comment('支付方式')->default(\App\Models\Order::STATUS_PENDING);
            $table->boolean('closed')->default(false)->comment("订单是否关闭");
            $table->string('status')->nullable()->comment('审核状态');
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
        Schema::dropIfExists('orders');
    }
}
