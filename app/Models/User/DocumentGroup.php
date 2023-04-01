<?php
declare(strict_types = 1);

namespace App\Models\User;

use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentGroup extends \App\Models\DocumentGroup
{
    public function doc(): HasMany
    {
        return $this->hasMany(Document::class, "group_uid", "uid")
            ->where("is_show", "=", 1);
    }
}
