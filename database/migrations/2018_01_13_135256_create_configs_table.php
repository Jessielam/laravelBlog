<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('conf_id');
            $table->integer('sort')->comment('显示排序');
            $table->string('conf_name')->unique()->comment('配置项名称');
            $table->string('conf_title')->unique()->comment('配置项标题');
            $table->text('conf_content')->comment('配置项内容');
            $table->string('conf_tips')->comment('备注');
            $table->string('inc_type', 64)->comment('字段输入类型');
            $table->string('field_value')->default('')->comment('类型值');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
