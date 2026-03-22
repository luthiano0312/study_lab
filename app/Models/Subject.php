<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\BelongsToUser;

class Subject extends Model
{
    use BelongsToUser;

    protected $fillable = ["user_id", "name", "abbreviation", "teacher", "semester"];

    /**
     * Get the user that owns the subject.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
