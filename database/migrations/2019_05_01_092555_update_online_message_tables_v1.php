<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOnlineMessageTablesV1 extends Migration
{

    public function up()
    {
        Schema::table('online_message', function (Blueprint $table) {
            $table->integer('room_id');
        });
    }


    public function down()
    {
        Schema::table('online_message', function (Blueprint $table) {
            $table->drop('room_id');
        });
    }
}
