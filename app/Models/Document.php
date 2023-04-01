<?php
declare(strict_types = 1);

namespace App\Models;

class Document extends BaseModel
{
    protected $table = "document";

    protected $fillable = [
        "title",
        "content",
        "is_show",
        "orders",
    ];

    protected $casts = [
        "uid" => "string",
    ];
}
