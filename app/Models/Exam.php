<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    protected $fillable = ["user_id", "type", "description", "due_date", "status"];

    /**
     * Get the user that owns the exam.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
