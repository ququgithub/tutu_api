<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banner";

    protected $fillable = [
        "uid",
        "first_title",
        "second_title",
        "url",
        "path",
        "is_show",
        "orders",
        "navigate",
    ];
}
