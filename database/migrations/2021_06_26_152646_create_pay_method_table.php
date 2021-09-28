<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_method', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('sort')->default(0);
            $table->string('name');
            $table->string('e_name')->comment('英文名称');
            $table->string('icon')->nullable()->comment('图标');
            $table->string('image')->nullable()->comment('收款码');
            $table->string('info')->nullable()->comment('收款信息');
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
        Schema::dropIfExists('pay_method');
    }
}
