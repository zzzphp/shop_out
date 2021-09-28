<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('new_version')->default('');
            $table->string('min_version')->default('');
            $table->string('url')->default('');
            $table->string('update_description')->default('');
            $table->string('size')->default('');
            $table->string('md5file')->nullable();
            $table->string('terminal')->default('android');
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
        Schema::dropIfExists('versions');
    }
}
