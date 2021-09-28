<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToInstallmentItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('installment_items', function (Blueprint $table) {
            //
            $table->string('pay_prove')->comment('支付证明')->nullable();
            $table->string('status')->default(\App\Models\InstallmentItem::STATUS_PENDING);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('installment_items', function (Blueprint $table) {
            //
            $table->dropColumn('pay_prove');
            $table->dropColumn('status');
        });
    }
}
