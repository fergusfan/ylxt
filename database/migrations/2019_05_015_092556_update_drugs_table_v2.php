<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDrugsTableV2 extends Migration
{

    public function up()
    {
        Schema::table('drugs', function (Blueprint $table) {
            $table->string('type')->comment('类别');
            $table->string('provider')->comment('供应商');
            $table->string('has')->comment('成分');
            $table->string('use')->comment('服用方法');
        });
    }


    public function down()
    {
        Schema::table('drugs', function (Blueprint $table) {
            $table->drop('type')->comment('类别');
            $table->drop('provider')->comment('供应商');
            $table->drop('has')->comment('成分');
            $table->drop('use')->comment('服用方法');
        });
    }
}
