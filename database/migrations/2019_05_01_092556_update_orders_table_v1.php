<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTableV1 extends Migration
{

    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamps();
        });
    }


    public function down()
    {
    }
}
