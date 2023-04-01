<?php
declare(strict_types = 1);

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends \App\Models\Document
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(DocumentGroup::class, "group_uid", "uid");
    }
}
