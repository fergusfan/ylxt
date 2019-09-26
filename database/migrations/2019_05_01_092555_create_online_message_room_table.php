<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineMessageRoomTable extends Migration
{

    public function up()
    {
        Schema::create('online_message_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('doctor_id');
        });
    }


    public function down()
    {
        Schema::drop('online_message_room');
    }
}
