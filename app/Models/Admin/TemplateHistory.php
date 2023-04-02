<?php
declare(strict_types = 1);

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateHistory extends \App\Models\TemplateHistory
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_uid", "uid");
    }
}
