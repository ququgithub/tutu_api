<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplate extends Migration
{
    public function up()
    {
        Schema::create('template_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("uid", false, true)->unique();
            $table->string("template_id", 100);
            $table->bigInteger("user_uid", false, true);
            $table->tinyInteger("is_used", false, true)->default(2);
            $table->tinyInteger("send_sate", false, true)->default(3);
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('template_history');
    }
}
