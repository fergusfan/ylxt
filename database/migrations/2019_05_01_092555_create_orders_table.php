<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('department')->comment('医院科室');
            $table->string('order_time')->comment('门诊时间');
            $table->string('description')->comment('病情描述');
        });
    }


    public function down()
    {
        Schema::drop('orders');
    }
}
