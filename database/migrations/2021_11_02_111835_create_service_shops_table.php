<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_shops', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id')->unique();
            $table->string('name')->comment('服务商名称');
            $table->string('phone')->comment('联系方式');
            $table->string('recharge_data')->nullable()->comment('充值额度');
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
        Schema::dropIfExists('service_shops');
    }
}
