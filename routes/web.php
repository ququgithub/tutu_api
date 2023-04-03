<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    $count = DB::table("emo_group")->count();
    $id    = 1;
    for ($i = 0; $i < $count; $i++) {
        $group = DB::table("emo_group")->where("id", "=", $id)->get(["uid"])->toArray();
        $cn    = DB::table("emo_image")->where("group_uid", "=", $group[0]->uid)->count();
        if ($cn < 1) {
            DB::table("emo_group")->where("id", "=", $id)->delete();
        }
        ++$id;
    }
});
