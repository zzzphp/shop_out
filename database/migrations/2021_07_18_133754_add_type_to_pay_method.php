<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToPayMethod extends Migration
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
            $table->dropColumn('image');
            $table->string('type')->default(\App\Models\PayMethod::TYPE_DIGITAL)
                ->after('id');
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
            $table->dropColumn('type');
        });
    }
}
