<?php
declare(strict_types = 1);

namespace App\Models;

class Series extends BaseModel
{
    protected $table = "series";

    protected $fillable = [
        "id",
        "uid",
        "title",
        "url",
        "path",
        "is_show",
        "orders",
        "created_at",
        "updated_at",
        "navigate"
    ];

    protected $casts = [
        "uid" => "string",
    ];
}
