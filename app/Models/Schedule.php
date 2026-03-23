<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\BelongsToUser;

class Schedule extends Model
{
    use BelongsToUser;
    protected $fillable = ['user_id', 'title', 'timetable_data'];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'timetable_data' => 'array',
        ];
    }

    /**
     * Get the user that owns the schedule.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
