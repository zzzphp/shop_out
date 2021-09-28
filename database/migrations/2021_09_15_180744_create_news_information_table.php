<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_information', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('summary');
            $table->text('content');
            $table->string('resource')->nullable()->comment('来源');
            $table->string('resource_url')->nullable()->comment('来源地址');
            $table->unsignedBigInteger('resource_id')->nullable()->comment('来源ID');
            $table->string('author')->nullable()->comment('作者');
            $table->string('thumbnail')->nullable()->comment('缩略图');
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
        Schema::dropIfExists('news_information');
    }
}
