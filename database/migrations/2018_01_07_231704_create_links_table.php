<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('link_id')->comment('友情连接id');
            $table->string('link_name')->nullable()->comment('友情连接名称');
            $table->string('link_title')->default('')->comment('友情连接标题');;
            $table->string('link_url')->nullable()->comment('友情连接url');;
            $table->integer('link_sort')->default(0)->comment('链接显示排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
