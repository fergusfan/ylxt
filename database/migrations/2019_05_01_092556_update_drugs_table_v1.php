<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDrugsTableV1 extends Migration
{

    public function up()
    {
        Schema::table('drugs', function (Blueprint $table) {
            $table->string('img');
        });
    }


    public function down()
    {
        Schema::table('drugs', function (Blueprint $table) {
            $table->drop('img');
        });
    }
}
