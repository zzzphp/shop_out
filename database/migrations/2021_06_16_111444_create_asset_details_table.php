<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_details', function (Blueprint $table) {
            $table->id();
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
            $table->decimal('front_amount', 18, 8)->default(0);
            $table->decimal('amount', 18, 8)->default(0);
            $table->decimal('after_amount', 18, 8)->default(0);
            $table->string('type')->comment('交易类型');
            $table->string('remark')->comment('备注');
            $table->string('sign')->comment('签名，保证当前数据不得被篡改');
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
        Schema::dropIfExists('asset_details');
    }
}
