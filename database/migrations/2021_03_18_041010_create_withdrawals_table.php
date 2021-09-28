<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Withdrawal;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
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
            $table->string('chain')->nullable()->comment('链名称');
            $table->string('coin_address')->nullable()->comment('地址');
            $table->decimal('amount',18,8)->comment('数量');
            $table->decimal('service_charge',18,8)->comment('手续费');
            $table->decimal('actual_amount',18,8)->comment('实际到账');
            $table->string('status')->default(Withdrawal::STATUS_PENDING);
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
        Schema::dropIfExists('withdrawals');
    }
}
