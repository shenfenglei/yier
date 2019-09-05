<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableAccountCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_acount', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content')->comment('收支说明');
            $table->integer('num')->default(0)->comment('变化金额');
            $table->integer('user_id')->default(0)->comment('用户id');
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
        Schema::dropIfExists('account_acount');

    }
}
