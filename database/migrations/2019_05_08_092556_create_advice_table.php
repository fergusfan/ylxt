<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviceTable extends Migration
{

    public function up()
    {
        Schema::create('advice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('advice');
    }
}
