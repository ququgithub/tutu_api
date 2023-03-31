<?php
declare(strict_types = 1);

namespace App\Models;

class Image extends BaseModel
{
    protected $table = "image";

    protected $fillable = [
        "uid",
        "user_uid",
        "author_uid",
        "series_uid",
        "category_uid",
        "item_count",
        "url",
        "path",
        "title",
        "download",
        "collect",
        "created_at",
        "updated_at",
    ];

    protected $casts = [
        "uid" => "string",
    ];
}
