<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthor extends Migration
{
    public function up()
    {
        // 作者信息
        Schema::create('author', function (Blueprint $table) {
            $table->id();
            $table->integer("uid", false, true)->unique();
            $table->integer("user_uid", false, true)->unique();
            $table->tinyInteger("is_forbidden", false, true)->default(2);
            $table->integer("series_count", false, true)->default(0);// 作品数量
            $table->string("qr_url", 100)->default("");// 个人二维码
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('author');
    }
}
