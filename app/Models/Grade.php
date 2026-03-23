<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\BelongsToUser;

class Grade extends Model
{
    use BelongsToUser;

    protected $fillable = ["user_id", "midterm", "endterm", "bimester", "year"];

    /**
     * Get the user that owns the grade.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
