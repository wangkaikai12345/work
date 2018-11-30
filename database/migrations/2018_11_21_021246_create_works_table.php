<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->integer('type_id')->comment('类型id');
            $table->integer('love_id')->default(0)->comment('处理人id');
            $table->integer('system_id')->comment('系统id');
            $table->string('title',255)->comment('工单标题');
            $table->text('content')->comment('工单内容');
            $table->enum('status', ['unsolved', 'allot', 'confirm', 'complete'])->comment('状态');
            $table->enum('level', ['low', 'middle', 'high'])->comment('级别');
            $table->integer('is_send')->default(0)->comment('是否通知');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
