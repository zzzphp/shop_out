<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installment_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('installment_id');
            $table->foreign('installment_id')
                ->references('id')
                ->on('installments')
                ->onDelete('cascade');
            $table->unsignedInteger('sequence')->comment('还款序号');
            $table->decimal('base')->comment('当期本金');
            $table->dateTime('due_date')->comment('还款截至日期');
            $table->dateTime('paid_at')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('refund_status')->comment('退款状态')->default(\App\Models\InstallmentItem::REFUND_STATUS_PENDING);
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
        Schema::dropIfExists('installment_items');
    }
}
