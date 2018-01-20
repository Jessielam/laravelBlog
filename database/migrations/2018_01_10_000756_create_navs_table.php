<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->increments('nav_id')->comment('自定义导航id');
            $table->string('nav_name')->nullable()->comment('自定义导航名称');
            $table->string('nav_alias')->nullable()->comment('自定义导航别名');;
            $table->string('nav_url')->nullable()->comment('自定义导航url');;
            $table->integer('nav_sort')->default(0)->comment('导航显示排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navs');
    }
}
