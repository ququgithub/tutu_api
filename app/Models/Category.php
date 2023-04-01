<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
