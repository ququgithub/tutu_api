<?php
declare(strict_types = 1);

namespace App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmoGroup extends \App\Models\EmoGroup
{
//    public function img(): HasMany
//    {
//        return $this->hasMany(EmoImage::class, "group_uid", "uid")
//            ->where("is_show", "=", 1);
//    }

    protected $appends = ["img"];

    public function getImgAttribute(): array
    {
        return EmoImage::query()->where([
            ["group_uid", "=", $this->getAttribute("uid")],
            ["is_show", "=", 1]
        ])->limit(4)
            ->get(["img_back"])
            ->toArray();
    }
}
