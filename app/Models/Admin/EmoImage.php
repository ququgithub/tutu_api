<?php
declare(strict_types = 1);

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmoImage extends \App\Models\EmoImage
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(EmoGroup::class, "group_uid", "uid");
    }
}
