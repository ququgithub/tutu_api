<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageItem extends Migration
{
    public function up()
    {
        Schema::create('image_item', function (Blueprint $table) {
            $table->id();
            $table->integer("uid", false, true)->unique();
            $table->integer("user_uid", false, true);
            $table->integer("author_uid", false, true);
            $table->integer("image_uid", false, true)->default(0);// 张数
            $table->string("url", 255);
            $table->string("path", 255);
            $table->integer("download", false, true)->default(0);// 下载数量
            $table->integer("collect", false, true)->default(0);// 收藏数量
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('image_item');
    }
}
