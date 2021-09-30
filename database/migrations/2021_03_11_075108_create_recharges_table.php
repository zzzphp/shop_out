<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Recharge;

class CreateRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->string('currency')->comment('币种');
            $table->string('chain')->nullable()->comment('链名');
            $table->decimal('amount',18,8)->comment('充值数量');
            $table->string('recharge_prove')->nullable()->comment('充值截图');
            $table->string('status')->default(Recharge::STATUS_PENDING)->comment('审核状态');
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
        Schema::dropIfExists('recharges');
    }
}
