<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    protected $fillable = ["user_id", "midterm", "endterm", "bimester", "year"];

    /**
     * Get the user that owns the grade.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
