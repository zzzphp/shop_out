<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image')->comment('产品图')->nullable();
            // $table->foreign('currency_id')
            //     ->references('id')
            //     ->on('currencies')
            //     ->onDelete('CASCADE');
            $table->string('title')->comment('产品标题');
            $table->string('description', 2048)->comment('简介');
            $table->decimal('original_price',10, 2)->comment('原价');
            $table->decimal('price', 10, 2)->comment('现价');
            $table->text('attributes')->comment('规格参数');
            $table->text('detail')->comment('产品说明');
            $table->time('begin_at')->comment('每天开始时间');
            $table->time('end_at')->comment('每天结束时间');
            $table->unsignedInteger('stock')->comment('库存');
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
        Schema::dropIfExists('products');
    }
}
