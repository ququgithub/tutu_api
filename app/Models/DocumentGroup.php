<?php
declare(strict_types = 1);

namespace App\Models;

class DocumentGroup extends BaseModel
{
    protected $table = "document_group";

    protected $fillable = [
        "uid",
        "title",
        "is_show",
        "orders"
    ];

    protected $casts = [
        "uid" => "string",
    ];
}
