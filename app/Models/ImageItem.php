<?php
declare(strict_types = 1);

namespace App\Models;

class ImageItem extends BaseModel
{
    protected $table = "image_item";

    protected $fillable = [
        "uid",
        "user_uid",
        "author_uid",
        "image_uid",
        "url",
        "path",
        "download",
        "collect",
        "created_at",
        "updated_at",
    ];

    protected $casts = [
        "uid" => "string",
    ];
}
