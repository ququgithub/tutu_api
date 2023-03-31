<?php
declare(strict_types = 1);

namespace App\Models\User;

use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageModel extends Image
{
    protected $hidden = [
        "user_uid",
        "author_uid",
        "series_uid",
        "category_uid",
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(AuthorModel::class, "author_uid", "uid");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, "user_uid", "uid");
    }
}
