<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanner extends Migration
{
    public function up()
    {
        // 轮播图
        Schema::create('banner', function (Blueprint $table) {
            $table->id();
            $table->integer("uid", false, true)->unique();
            $table->string("first_title", 32);
            $table->string("second_title", 32)->nullable();
            $table->string("url", 255);
            $table->string("path", 255);
            $table->tinyInteger("is_show", false, true)->default(2);
            $table->integer("orders", false, true)->default(0);
            $table->string("navigate", 255)->nullable();// 跳转地址
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner');
    }
}
