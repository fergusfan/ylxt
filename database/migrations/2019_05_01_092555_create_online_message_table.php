<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineMessageTable extends Migration
{

    public function up()
    {
        Schema::create('online_message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('doctor_id');
            $table->string('tell_id')->comment('回复此条信息的id');
            $table->longText('message');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('online_message');
    }
}
