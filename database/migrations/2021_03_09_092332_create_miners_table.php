<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miners', function (Blueprint $table) {
            $table->id();
            $table->string('hash_key')->unique()->index();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')
            ->references('id')
            ->on('currencies')
            ->onDelete('cascade');
            $table->unsignedInteger('amount');
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
        Schema::dropIfExists('miners');
    }
}
