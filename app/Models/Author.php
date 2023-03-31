<?php
declare(strict_types = 1);

namespace App\Models;

class Author extends BaseModel
{
    protected $table = "author";

    protected $fillable = [
        "uid",
        "user_uid",
        "is_forbidden",
        "series_count",
        "qr_url",
        "created_at",
        "updated_at",
    ];
}
