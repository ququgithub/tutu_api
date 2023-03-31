<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUser extends Migration
{
    public function up()
    {
        // 微信用户
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("uid", false, true)->unique();
            $table->string("nickname", 32);
            $table->string("mobile", 32)->nullable()->unique();
            $table->string("email", 32)->nullable()->unique();
            $table->string("avatar_url", 1000)->default("https://img.wxcha.com/m00/50/12/81b6ba3f79a9565ec32bd6d596a99944.jpg");
            $table->tinyInteger("gender", false, true)->default(0);
            $table->tinyInteger("age", false, true)->default(0);
            $table->date("birthday")->nullable();
            $table->string("remark", 100)->default("这家伙很懒，什么都没留下");
            $table->tinyInteger("profession", false, true)->default("其他");// 职业
            $table->decimal("score", 20, 2)->default(0.00);
            $table->integer("invite_count", false, true)->default(0);
            $table->integer("production_count", false, true)->default(0);
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}
