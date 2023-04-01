<?php
declare(strict_types = 1);

namespace App\Models\Admin;


use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends \App\Models\Image
{
    protected $appends = [
        "cover"
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, "author_uid", "uid");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_uid", "uid");
    }

    public function getCoverAttribute($key): string
    {
        return $this->getAttribute("url") . $this->getAttribute("path");
    }

    public function item(): HasMany
    {
        return $this->hasMany(ImageItem::class, "image_uid", "uid");
    }
}
