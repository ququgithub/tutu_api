<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
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
}
