<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTable extends Migration
{

    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('药品id');
            $table->string('name')->comment('药品名');
            $table->string('price')->comment('药品价格');
            $table->string('description')->comment('药品描述');
        });
    }


    public function down()
    {
        Schema::drop('drugs');
    }
}
