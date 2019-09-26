<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersDoctorTable extends Migration
{

    public function up()
    {
        Schema::table('users_doctors', function (Blueprint $table) {
            $table->string('title')->comment('职称');
        });
    }


    public function down()
    {
        Schema::table('users_doctors', function (Blueprint $table) {
            $table->drop('title');
        });
    }
}
