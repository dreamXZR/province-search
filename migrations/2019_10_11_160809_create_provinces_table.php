<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('area_name')->comment('地区名称')->index();
            $table->integer('area_code')->comment('地区编码');
            $table->string('city_code')->comment('城市编码');
            $table->tinyInteger('level')->comment('地区等级')->index();
            $table->string('area_index')->comment('地区索引')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_provinces');
    }
}
