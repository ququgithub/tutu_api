<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeries extends Migration
{
    public function up()
    {
        // 图片系列
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->integer("uid", false, true)->unique();
            $table->string("title", 32);
            $table->string("url", 255);
            $table->string("path", 255);
            $table->tinyInteger("is_show", false, true)->default(2);
            $table->integer("orders", false, true)->default(0);
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('series');
    }
}
