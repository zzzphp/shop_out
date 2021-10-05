<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanDetailedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_detaileds', function (Blueprint $table) {
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
            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id')
                ->references('id')
                ->on('loans')
                ->onDelete('RESTRICT');
            $table->decimal('to_be_returned', 18, 2)->comment('待还');
            $table->decimal('interest', 18, 2)->comment('利息');
            $table->decimal('total_amount', 18, 2)->comment('当日总收益');
            $table->decimal('amount', 18, 2)->comment('本次还款数量');
            $table->tinyInteger('profit_rate')->comment('收益还款比率%');
            $table->decimal('interest_rate', 10, 2)->comment('日利率%');
            $table->date('dated')->comment('还款日');
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
        Schema::dropIfExists('loan_detaileds');
    }
}
