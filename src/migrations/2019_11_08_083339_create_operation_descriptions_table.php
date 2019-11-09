<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 32)->comment('operation name');
            $table->string('description', 256)->default('')->comment('operation description');
            $table->string('controller', 128)->comment('controller name');
            $table->string('function', 128)->comment('function name');
            $table->tinyInteger('is_deleted')->default('0')->comment('is deleted, 0:no,1:yes');
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
        Schema::dropIfExists('operation_descriptions');
    }
}
