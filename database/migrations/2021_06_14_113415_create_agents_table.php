<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Agent;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('商户主体');
            $table->string('name')->comment('名称');
            $table->string('address')->comment('联系地址');
            $table->string('phone')->comment('联系电话');
            $table->string('legal_person')->comment('法人姓名')->nullable();
            $table->string('idcard')->comment('证件号码');
            $table->string('image')->comment('证件照片');
            $table->boolean('ability')->comment('是否可以发展代理')->default(true);
            $table->tinyInteger('sales_ratio')->comment('销售返佣比率')->default(0);
            $table->unsignedBigInteger('admin_parent_id');
            $table->foreign('admin_parent_id')
            ->references('id')
            ->on('admin_users')
            ->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
            ->references('id')
            ->on('admin_users')
            ->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->comment('层级关系字段');
            $table->foreign('parent_id')
                ->references('id')
                ->on('agents')
                ->onDelete('cascade');
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
        Schema::dropIfExists('agents');
    }
}
