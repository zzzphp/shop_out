<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributesAutomaticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributes_automatic', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->tinyInteger('first')->default(0)->nullable();
            $table->integer('line_day')->default(0)->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('RESTRICT');
            $table->unsignedBigInteger('stage_id');
            $table->foreign('stage_id')
                ->references('id')
                ->on('stages')
                ->onDelete('RESTRICT');
            $table->date('dated')->comment('收益日期');
            $table->decimal('amount', 18, 2)->comment('平均收益');
            $table->string('formula')->comment('计算公式');
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
        Schema::dropIfExists('distributes_automatic');
    }
}
