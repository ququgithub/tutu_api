<?php
declare(strict_types = 1);

namespace App\Models;

class User extends BaseModel
{
    protected $table = "user";

    protected $fillable = [
        "id",
        "uid",
        "openid",
        "nickname",
        "mobile",
        "email",
        "avatar_url",
        "gender",
        "age",
        "birthday",
        "remark",
        "profession",
        "score",
        "invite_count",
        "production_count",
        "name",
    ];

    public function getEmailAttribute($key): string
    {
        return !empty($key) ? $key : "";
    }

    public function getMobileAttribute($key): string
    {
        return !empty($key) ? $key : "";
    }

    public function getBirthdayAttribute($key): string
    {
        return !empty($key) ? $key : "";
    }

    public function getNameAttribute($key): string
    {
        return !empty($key) ? $key : "";
    }
}
