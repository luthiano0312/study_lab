<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    protected $fillable = ["user_id", "name", "teacher", "semester"];

    /**
     * Get the user that owns the content.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
