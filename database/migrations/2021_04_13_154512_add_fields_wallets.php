<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsWallets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            //
        $table->decimal('withdrawal_amount', 18, 2)->comment('提现数量')->after('amount')->default(0);
        $table->decimal('frozen_amount', 18, 2)->comment('冻结数量')->after('amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            //
            $table->dropColum('frozen_amount');
            $table->dropColum('withdrawal_amount');
        });
    }
}
