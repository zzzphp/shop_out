<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
    		$table->string('title')->nullable();
    		$table->string('type');
    		$table->text('content');
    		$table->string('looks')->comment('查看次数')->default(0);
    		$table->string('stars')->comment('星级');
    		$table->string('look_up')->comment('看涨')->default(0);
    		$table->string('look_down')->comment('看跌')->default(0);
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
        Schema::dropIfExists('news');
    }
}
