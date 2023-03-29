<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImage extends Migration
{
    public function up()
    {
        // 图片基础信息
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("uid", false, true)->unique();
            $table->bigInteger("user_uid", false, true);
            $table->bigInteger("author_uid", false, true);
            $table->bigInteger("series_uid", false, true);
            $table->bigInteger("category_uid", false, true);
            $table->integer("item_count", false, true)->default(0);// 张数
            $table->string("url", 255);
            $table->string("path", 255);
            $table->string("title", 32);
            $table->integer("download", false, true)->default(0);// 下载数量
            $table->integer("collect", false, true)->default(0);// 收藏数量
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('image');
    }
}
