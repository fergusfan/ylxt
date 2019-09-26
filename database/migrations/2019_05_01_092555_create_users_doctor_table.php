<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDoctorTable extends Migration
{

    public function up()
    {
        Schema::create('users_doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('good_at')->comment('擅长');
            $table->string('service_time')->comment('门诊时间');
            $table->string('department')->comment('医院科室');
        });
    }

    public function down()
    {
        Schema::drop('users_doctors');
    }
}
