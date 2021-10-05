<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
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
            $table->decimal('interest_rate', 10, 2)->default(0)->comment('日利率%');
            $table->tinyInteger('profit_rate')->comment('收益还款比率%');
            $table->decimal('total_amount', 18, 2)->comment('总本金');
            $table->decimal('to_be_returned', 18, 2)->comment('待还');
            $table->unsignedInteger('count')->default(0)->comment('已还次数');
            $table->decimal('already_interest', 18, 2)->default(0)->comment('已还利息');
            $table->date('last_dated')->nullable()->comment('上次归还日期');
            $table->string('status')->default(\App\Models\Loan::STATUS_PENDING)->comment('状态');
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
        Schema::dropIfExists('loans');
    }
}
