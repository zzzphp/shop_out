<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRateToPayMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_method', function (Blueprint $table) {
            //
            $table->decimal('rate', '10', 2)
                ->default(1)
                ->nullable()
                ->after('real_info')
                ->comment('汇率');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_method', function (Blueprint $table) {
            //
            $table->dropColumn('rate');
        });
    }
}
