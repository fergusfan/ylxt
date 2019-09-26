<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTableV2 extends Migration
{

    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_replay')->nullable();
        });
    }


    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->drop('order_replay');
        });
    }
}
