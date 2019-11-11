<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('operation_description_id')->default('0')->comment('operation_descriptions primary key');
            $table->bigInteger('operate_user_id')->comment('operate user id');
            $table->string('request_uri', 128)->comment('request uri name');
            $table->string('controller', 128)->comment('controller name');
            $table->string('function', 128)->comment('function name');
            $table->text('request_params')->comment('request parameters');
            $table->text('request_extension_params')->comment('request extension parameters');
            $table->text('response_data')->comment('response data');
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
        Schema::dropIfExists('operation_logs');
    }
}

//CREATE TABLE `shopping_admin_operation_logs` (
//`id` bigint(20) NOT NULL AUTO_INCREMENT,
//`action_id` bigint(20) DEFAULT NULL COMMENT '方法id',
//`admin_uid` bigint(20) NOT NULL COMMENT '操作用户id',
//`control` varchar(100) DEFAULT NULL COMMENT '请求方法',
//`func` varchar(100) DEFAULT NULL COMMENT '请求路径',
//`params` longtext COMMENT '请求参数',
//`ex_params` text COMMENT '额外参数',
//`created_at` timestamp NULL DEFAULT NULL,
//`updated_at` timestamp NULL DEFAULT NULL,
//`deleted_at` timestamp NULL DEFAULT NULL,
//PRIMARY KEY (`id`)
//) ENGINE=InnoDB DEFAULT CHARSET=utf8;
