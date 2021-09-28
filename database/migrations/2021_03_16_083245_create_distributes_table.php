<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Distribute;
class CreateDistributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributes', function (Blueprint $table) {
            $table->id();
            $table->string('hash_key')->unique();
            $table->date('day')->comment('日期');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('RESTRICT');
            $table->decimal('total_amount',18,8)->comment('总数');
            $table->string('info')->nullable()->comment('信息');
            $table->string('status')->default(Distribute::STATUS_NO_STARTED)->comment('状态');
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
        Schema::dropIfExists('distributes');
    }
}
