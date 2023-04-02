<?php
declare(strict_types = 1);

namespace App\Models;

class Category extends BaseModel
{
    protected $table = "category";

    protected $fillable = [
        "uid",
        "title",
        "is_show",
        "orders",
    ];

    protected $casts = [
        "uid" => "string",
    ];
}
