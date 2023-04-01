<?php
declare(strict_types = 1);

namespace App\Models;

class TemplateHistory extends BaseModel
{
    protected $table = "template_history";

    protected $fillable = [
        "uid",
        "template_id",
        "user_uid",
        "is_used",
        "send_sate",
        "created_at",
        "updated_at"
    ];
}
